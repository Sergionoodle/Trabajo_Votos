<?php

class join_user
{
    private string $usuario;

    /**
     * @param string $usuario
     */
    public function __construct(string $usuario)
    {
        $this->usuario = $usuario;
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