<?php

class resultado
{

    private $distrito;
    private $partido;
    private $votos;
    private $escanos = 0;
    private $divisor = 1;

    /**
     * @param $distrito
     * @param $partido
     * @param $votos
     */
    public function __construct($distrito, $partido, $votos)
    {
        $this->distrito = $distrito;
        $this->partido = $partido;
        $this->votos = $votos;
    }

    /**
     * @return mixed
     */
    public function getDistrito()
    {
        return $this->distrito;
    }

    /**
     * @return mixed
     */
    public function getEscanos()
    {
        return $this->escanos;
    }

    /**
     * @param mixed $escanos
     */
    public function setEscanos($escanos)
    {
        $this->escanos = $escanos;
    }
    /**
     * @return int
     */
    public function getDivisor()
    {
        return $this->divisor;
    }

    /**
     * @param int $divisor
     */
    public function setDivisor($divisor)
    {
        $this->divisor = $divisor;
    }
    /**
     * @param mixed $distrito
     */
    public function setDistrito($distrito)
    {
        $this->distrito = $distrito;
    }

    /**
     * @return mixed
     */
    public function getPartido()
    {
        return $this->partido;
    }

    /**
     * @param mixed $partido
     */
    public function setPartido($partido)
    {
        $this->partido = $partido;
    }

    /**
     * @return mixed
     */
    public function getVotos()
    {
        return $this->votos;
    }

    /**
     * @param mixed $votos
     */
    public function setVotos($votos)
    {
        $this->votos = $votos;
    }


}