<?php

class partidos
{
    private $id;
    private $nombre;
    private $acronimo;
    private $logo;

    //Para sacar el total de votos y escaños para la parte de general
    private $totalVotos;
    private $totalEscanos;

    /**
     * @param $id
     * @param $nombre
     * @param $acronimo
     * @param $logo
     */
    public function __construct($id, $nombre, $acronimo, $logo)
    {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->acronimo = $acronimo;
        $this->logo = $logo;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTotalVotos()
    {
        return $this->totalVotos;
    }

    /**
     * @param mixed $totalVotos
     */
    public function setTotalVotos($totalVotos)
    {
        $this->totalVotos = $totalVotos;
    }

    /**
     * @return mixed
     */
    public function getTotalEscanos()
    {
        return $this->totalEscanos;
    }

    /**
     * @param mixed $totalEscanos
     */
    public function setTotalEscanos($totalEscanos)
    {
        $this->totalEscanos = $totalEscanos;
    }


    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getAcronimo()
    {
        return $this->acronimo;
    }

    /**
     * @param mixed $acronimo
     */
    public function setAcronimo($acronimo)
    {
        $this->acronimo = $acronimo;
    }

    /**
     * @return mixed
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * @param mixed $logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    }


}