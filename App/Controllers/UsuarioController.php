<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\DAO\UsuariosDAO;
use App\Models\UsuarioModel;


class UsuarioController extends ControladorBaseController
{
    /**
     * Função para insert de Usuario
     * @param Request $request
     * @param Response $response
     * @param array $args
     * @return Response
     */
    public function insert(Request $request, Response $response, array $args): Response
    {
        //Obter dados da requisicao
        $data = $request->getParsedBody();
        $usuarioDAO = new UsuariosDAO();
        //Verificar se e-mail existe
        $usuario = $usuarioDAO->getUserByEmail($data['email']);
        //Verifica se email existe
        if (!is_null($usuario)) {
            $response = $response->withJson([
                'message' => 'E-mail: '. $usuario->getEmail() .' já cadastrado',
                'id' => $usuario->getId(),
                'nome' => $usuario->getNome(),
                'sobrenome' => $usuario->getSobrenome()
            ]);
            return $response;
        }
        //Verifica se CPF existe
        $usuario = $usuarioDAO->getUserByCpf($data['cpf']);
        if (!is_null($usuario)) {
            $response = $response->withJson([
                'message' => 'CPF: '. $usuario->getCpf() .' já cadastrado',
                'id' => $usuario->getId(),
                'nome' => $usuario->getNome(),
                'sobrenome' => $usuario->getSobrenome()
            ]);
            return $response;
        }
        $usuario = new UsuarioModel();
        $usuario->setNome($data['nome']);
        $usuario->setSobrenome($data['sobrenome']);
        $usuario->setCpf($data['cpf']);
        $usuario->setEmail($data['email']);
        $usuario->setSenha($data['senha']);
        $usuario->setSaldo($data['saldo']);
        $usuario->setTipoUsuarioId($data['tipo_usuario']);

        $result= $usuarioDAO->insertUser($usuario);


        if($result>0){
            $response = $response->withJson([
                'message' => 'Usuario cadastrado com sucesso!',
                'id' => $result
           ]);

        }else{

            $response = $response->withJson([
                'message' => 'Erro cadastrando usuário!',

            ]);


        }


        return $response;
    }

    protected function get(Request $request, Response $response, array $args): Response
    {
       return $response;
    }

    protected function update(Request $request, Response $response, array $args): Response
    {
        return $response;
    }

    protected function delete(Request $request, Response $response, array $args): Response
    {
        return $response;
    }
}
