<?php

namespace App\Models;

final class UsuarioModel
{
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $nome;

    /**
     * @var string
     */
    private $sobrenome;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $senha;
    /**
     * @var string
     */
    private $cpf;

    /**
     * @var string
     */
    private $saldo;

    /**
     * @var int
     */
    private $tipo_usuario_id;


    private $descricao_tipo_usuario;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getNome(): string
    {
        return $this->nome;
    }

    /**
     * @param string $nome
     * @return self
     */
    public function setNome(string $nome): self
    {
        $this->nome = $nome;
        return $this;
    }

    /**
     * @return string
     */
    public function getSobrenome(): string
    {
        return $this->sobrenome;
    }

    /**
     * @param string $sobrenome
     */
    public function setSobrenome(string $sobrenome): void
    {
        $this->sobrenome = $sobrenome;
    }



    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return self
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getSenha(): string
    {
        return $this->senha;
    }

    /**
     * @param string $senha
     * @return self
     */
    public function setSenha(string $senha): self
    {
        $this->senha = $senha;
        return $this;
    }

    /**
     * @return string
     */
    public function getCpf(): string
    {
        return $this->cpf;
    }

    /**
     * @param string $cpf
     * @return self
     */
    public function setCpf(string $cpf): self
    {
        $this->cpf = $cpf;
        return $this;
    }

    /**
     * @return string
     */
    public function getSaldo(): string
    {
        return $this->saldo;
    }

    /**
     * @param string $saldo
     */
    public function setSaldo(string $saldo): void
    {
        $this->saldo = $saldo;
    }

    /**
     * @return int
     */
    public function getTipoUsuarioId(): int
    {
        return $this->tipo_usuario_id;
    }

    /**
     * @param int $tipo_usuario_id
     */
    public function setTipoUsuarioId(int $tipo_usuario_id): void
    {
        $this->tipo_usuario_id = $tipo_usuario_id;
    }

    /**
     * @return mixed
     */
    public function getDescricaoTipoUsuario()
    {
        return $this->descricao_tipo_usuario;
    }

    /**
     * @param mixed $descricao_tipo_usuario
     */
    public function setDescricaoTipoUsuario($descricao_tipo_usuario): void
    {
        $this->descricao_tipo_usuario = $descricao_tipo_usuario;
    }



}
