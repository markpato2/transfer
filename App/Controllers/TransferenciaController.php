<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\DAO\UsuariosDAO;
use App\Models\UsuarioModel;


class TransferenciaController
{

    public function transfer(Request $request, Response $response, array $args): Response
    {
        try {

            //Obter dados da requisicao
            $data = $request->getParsedBody();
            $usuarioDAO = new UsuariosDAO();
            $valorTransferencia = $data['valor'];
            $urlServiceAutorizar= getenv('URL_AUTORIZAR');
            $urlServicoNotificacao = getenv('URL_NOTIFICACAO');

            //Obter dados de Usuario Pagador
            $usuarioPagador = $usuarioDAO->getUserById($data['pagador']);
            $tipoUsuario = $usuarioPagador->getDescricaoTipoUsuario();
            $usuarioBeneficiario = $usuarioDAO->getUserById($data['beneficiario']);

            //Verifica que o usuario pagador e beneficiario sejem diferentes
            if($usuarioBeneficiario==$usuarioPagador){
                $response = $response->withJson(['message' => 'Usuário pagador e beneficiário não pode ser o mesmo']);
                return $response;
            }

            //Verifica se usuario é lojista
            if ($tipoUsuario == "lojista") {
                $response = $response->withJson([
                    'message' => $tipoUsuario . ' não esta autorizado para enviar dinheiro',
                    'id' => $usuarioPagador->getId(),
                    'nome' => $usuarioPagador->getNome(),
                    'sobrenome' => $usuarioPagador->getSobrenome()
                ]);
                return $response;
            }

            //Valida Saldo de Usuario Pagador
            $saldoUsuario = $usuarioPagador->getSaldo();
            if($saldoUsuario<$valorTransferencia){
                $response = $response->withJson([
                    'message' => ' Saldo de usuário insuficiente',
                    'id' => $usuarioPagador->getId(),
                    'saldo' => $saldoUsuario,
                ]);
                return $response;

            }
            //Chamado ao serviço de Autorização
            $autoriza=$this->serviceAutorizador($urlServiceAutorizar);
            //Se esta autorizado executa a transferencia
            if($autoriza->message=="Autorizado"){

                $saldoFinalPagador = $saldoUsuario - $valorTransferencia;
                $saldoFinalBeneficiario = $usuarioBeneficiario->getSaldo() + $valorTransferencia;
                $resultado= $usuarioDAO->executaTransferencia($saldoFinalPagador,$saldoFinalBeneficiario,$usuarioPagador->getId(),$usuarioBeneficiario->getId());

                if($resultado){
                    $response = $response->withJson([
                        'message' => 'Transferencia com sucesso!'
                    ]);

                    $this->enviaNotificacao($urlServicoNotificacao);

                }else{
                    $response = $response->withJson([
                        'message' => 'Transferencia não realizada!'
                    ]);
                }


            }else{

                $response = $response->withJson([
                    'message' => 'Não Autorizado',
                    'id' => $usuarioPagador->getId()
                ]);
                return $response;

            }
            return $response;

        }catch (\Exception $e){

            return $e;
        }

    }

    private function serviceAutorizador($url){

      return $this->executaCurl($url);

    }

    private function enviaNotificacao($url){

       return $this->executaCurl($url);
    }

    private function executaCurl($url){
         //Uso CURL para consumir o serviço
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);            // No header in the result
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); // Return, do not echo result
        $raw_data = curl_exec($ch);
        curl_close($ch);
        // Transforma para JSON.
        $data = json_decode($raw_data);
        return $data;
}


}
