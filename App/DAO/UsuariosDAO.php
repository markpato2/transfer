<?php

namespace App\DAO;

use App\Models\UsuarioModel;

class UsuariosDAO extends Conexao
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Função para retornar usuario com parametro email
     * @param string $email
     * @return UsuarioModel|null
     */
    public function getUserByEmail(string $email): ?UsuarioModel
    {
        $statement = $this->pdo
            ->prepare('SELECT
                    id,
                    nome,
                    sobrenome,
                    email,
                    senha,
                    cpf,
                    saldo,
                    tipo_usuario_id

                FROM usuarios
                WHERE email = :email;
            ');
        $statement->bindParam('email', $email);
        $statement->execute();
        $usuarios = $statement->fetchAll(\PDO::FETCH_ASSOC);
        if(count($usuarios) === 0)
            return null;
        $usuario = new UsuarioModel();
        $usuario->setId($usuarios[0]['id']);
        $usuario->setNome($usuarios[0]['nome']);
        $usuario->setSobrenome($usuarios[0]['sobrenome']);
        $usuario->setEmail($usuarios[0]['email']);
        $usuario->setSenha($usuarios[0]['senha']);
        $usuario->setCpf($usuarios[0]['cpf']);
        $usuario->setSaldo($usuarios[0]['saldo']);
        $usuario->setTipoUsuarioId($usuarios[0]['tipo_usuario_id']);
        return $usuario;
    }

    public function getUserByCpf(string $cpf): ?UsuarioModel
    {
        $statement = $this->pdo
            ->prepare('SELECT
                    id,
                    nome,
                    sobrenome,
                    email,
                    senha,
                    cpf,
                    saldo
                FROM usuarios
                WHERE cpf = :cpf;
            ');
        $statement->bindParam('cpf', $cpf);
        $statement->execute();
        $usuarios = $statement->fetchAll(\PDO::FETCH_ASSOC);
        if(count($usuarios) === 0)
            return null;
        $usuario = new UsuarioModel();
        $usuario->setId($usuarios[0]['id']);
        $usuario->setNome($usuarios[0]['nome']);
        $usuario->setSobrenome($usuarios[0]['sobrenome']);
        $usuario->setEmail($usuarios[0]['email']);
        $usuario->setSenha($usuarios[0]['senha']);
        $usuario->setCpf($usuarios[0]['cpf']);
        $usuario->setSaldo($usuarios[0]['saldo']);

        return $usuario;
    }

    public function getUserById(string $id): ?UsuarioModel
    {
        $statement = $this->pdo
            ->prepare('SELECT
                    u.id,
                    u.nome,
                    u.sobrenome,
                    u.email,
                    u.senha,
                    u.cpf,
                    u.saldo,
                    u.tipo_usuario_id,
                    tp.descricao
                FROM usuarios as u
                INNER JOIN tipo_usuario as tp
                ON  u.tipo_usuario_id = tp.id WHERE u.id = :id;
            ');
        $statement->bindParam('id', $id);
        $statement->execute();
        $usuarios = $statement->fetchAll(\PDO::FETCH_ASSOC);

        if(count($usuarios) === 0)
            return null;
        $usuario = new UsuarioModel();
        $usuario->setId($usuarios[0]['id']);
        $usuario->setNome($usuarios[0]['nome']);
        $usuario->setSobrenome($usuarios[0]['sobrenome']);
        $usuario->setEmail($usuarios[0]['email']);
        $usuario->setSenha($usuarios[0]['senha']);
        $usuario->setCpf($usuarios[0]['cpf']);
        $usuario->setSaldo($usuarios[0]['saldo']);
        $usuario->setTipoUsuarioId($usuarios[0]['tipo_usuario_id']);
        $usuario->setDescricaoTipoUsuario($usuarios[0]['descricao']);
        return $usuario;
    }

    public function insertUser(UsuarioModel $usuario):int{


        $statement = $this->pdo
            ->prepare('INSERT INTO usuarios
            (
                email,
                tipo_usuario_id,
                nome,
                sobrenome,
                cpf,
                senha,
                saldo
            )
            VALUES
            (
                :email,
                :tipo_usuario_id,
                :nome,
                :sobrenome,
                :cpf,
                :senha,
                :saldo
            );
        ');
        $statement->execute([

            'email' => $usuario->getEmail(),
            'tipo_usuario_id' => $usuario->getTipoUsuarioId(),
            'nome' => $usuario->getNome(),
            'sobrenome' => $usuario->getSobrenome(),
            'cpf' => $usuario->getCpf(),
            'senha' => $usuario->getSenha(),
            'saldo' => $usuario->getSaldo()
        ]);

        return $this->pdo->lastInsertId();

    }

    public function executaTransferencia(float $valorPagador,float $valorBeneficiario,int $idPagador, int $idBeneficiario): bool {

        try {
            //Inicia Transação
            $this->pdo->beginTransaction();
            $statement = $this->pdo
                ->prepare('
                    UPDATE usuarios SET
                    saldo = :valorPagador
                WHERE
                    id = :idPagador
            ;');
            $statement->execute([
                'valorPagador' => $valorPagador,
                'idPagador' => $idPagador
            ]);

            $statement = $this->pdo
                ->prepare('
                    UPDATE usuarios SET
                    saldo = :valorBeneficiario
                WHERE
                    id = :idBeneficiario
            ;');
            $statement->execute([
                'valorBeneficiario' => $valorBeneficiario,
                'idBeneficiario' => $idBeneficiario
            ]);
            //Finaliza Transação
            $this->pdo->commit();

            return true;

        }catch (\PDOException $ex){
            //Rollback se acontece alguma inconsistência
            $this->pdo->rollBack();


            return false;
        }


    }
}
