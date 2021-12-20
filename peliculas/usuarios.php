<?php

class usuarios
{

    private int $id;
    private string $email;
    private string $password;
    private string $usuario;

    /**
     * @param int $id
     * @param string $email
     * @param string $password
     * @param string $usuario
     */
    public function __construct(int $id, string $email, string $password, string $usuario)
    {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->usuario = $usuario;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
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
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getUsuario(): string
    {
        return $this->usuario;
    }

    /**
     * @param string $usuario
     */
    public function setUsuario(string $usuario): void
    {
        $this->usuario = $usuario;
    }

}