<?php



class provincia
{

    private $idProv;
    private $nomProv;
    private $delegados;


    /**
     * @param $idProv
     * @param $nomProv
     */
    public function __construct($idProv, $nomProv, $delegados)
    {
        $this->idProv = $idProv;
        $this->nomProv = $nomProv;
        $this->delegados = $delegados;
    }



    /**
     * @return mixed
     */
    public function getDelegados()
    {
        return $this->delegados;
    }

    /**
     * @param mixed $delegados
     */
    public function setDelegados($delegados)
    {
        $this->delegados = $delegados;
    }

    /**
     * @return mixed
     */
    public function getIdProv()
    {
        return $this->idProv;
    }

    /**
     * @param mixed $idProv
     */
    public function setIdProv($idProv)
    {
        $this->idProv = $idProv;
    }

    /**
     * @return mixed
     */
    public function getNomProv()
    {
        return $this->nomProv;
    }

    /**
     * @param mixed $nomProv
     */
    public function setNomProv($nomProv)
    {
        $this->nomProv = $nomProv;
    }


}