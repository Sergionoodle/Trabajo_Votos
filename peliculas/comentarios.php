<?php

include_once "sql.php";
include_once "usuarios.php";
include_once "principal.php";

class comentarios
{

  private int $id;
  private int $idUsuario;
  private int $idPelicula;
  private string $comentario;

    /**
     * @param int $id
     * @param int $idUsuario
     * @param int $idPelicula
     * @param string $comentario
     */
    public function __construct(int $id, int $idUsuario, int $idPelicula, string $comentario)
    {
        $this->id = $id;
        $this->idUsuario = $idUsuario;
        $this->idPelicula = $idPelicula;
        $this->comentario = $comentario;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getIdUsuario(): int
    {
        return $this->idUsuario;
    }

    /**
     * @return int
     */
    public function getIdPelicula(): int
    {
        return $this->idPelicula;
    }

    /**
     * @return string
     */
    public function getComentario(): string
    {
        return $this->comentario;
    }


}