<?php
//incluimos multimedia y staff
include_once "multimedia.php";
include_once "staff.php";

//creamos la clase principal que tendra el id de las peliculas, un id referenciado con la clase multimedia
//el titulo, genero, puntuacion, un id referenciado con el staff y la descripcion de la pelicula
class principal
{

    private int $id;

    //idMultimedia lo llamas de multimedia
    private multimedia $idMultimedia;
    private string $titulo;
    private string $genero;
    private int $puntuacion;

    //el idstaff lo sacas siendo un staff
    private staff $idStaff;
    private string $descripcion;

    /**
     * @param int $id
     * @param multimedia $idMultimedia
     * @param string $titulo
     * @param string $genero
     * @param int $puntuacion
     * @param staff $idStaff
     * @param string $descripcion
     */
    public function __construct(int $id, multimedia $idMultimedia, string $titulo, string $genero, int $puntuacion, staff $idStaff, string $descripcion)
    {
        $this->id = $id;
        $this->idMultimedia = $idMultimedia;
        $this->titulo = $titulo;
        $this->genero = $genero;
        $this->puntuacion = $puntuacion;
        $this->idStaff = $idStaff;
        $this->descripcion = $descripcion;
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
     * @return multimedia
     */
    public function getIdMultimedia(): multimedia
    {
        return $this->idMultimedia;
    }

    /**
     * @param multimedia $idMultimedia
     */
    public function setIdMultimedia(multimedia $idMultimedia): void
    {
        $this->idMultimedia = $idMultimedia;
    }

    /**
     * @return string
     */
    public function getTitulo(): string
    {
        return $this->titulo;
    }

    /**
     * @param string $titulo
     */
    public function setTitulo(string $titulo): void
    {
        $this->titulo = $titulo;
    }

    /**
     * @return string
     */
    public function getGenero(): string
    {
        return $this->genero;
    }

    /**
     * @param string $genero
     */
    public function setGenero(string $genero): void
    {
        $this->genero = $genero;
    }

    /**
     * @return int
     */
    public function getPuntuacion(): int
    {
        return $this->puntuacion;
    }

    /**
     * @param int $puntuacion
     */
    public function setPuntuacion(int $puntuacion): void
    {
        $this->puntuacion = $puntuacion;
    }

    /**
     * @return staff
     */
    public function getIdStaff(): staff
    {
        return $this->idStaff;
    }

    /**
     * @param staff $idStaff
     */
    public function setIdStaff(staff $idStaff): void
    {
        $this->idStaff = $idStaff;
    }

    /**
     * @return string
     */
    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    /**
     * @param string $descripcion
     */
    public function setDescripcion(string $descripcion): void
    {
        $this->descripcion = $descripcion;
    }


}