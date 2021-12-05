<?php
//Creamos la clase de staff que contendra su id, el nombre del director y el nombre del protagonista
class staff
{

    private int $id;
    private string $director;
    private  string $prota;

    /**
     * @param int $id
     * @param string $director
     * @param string $prota
     */
    public function __construct(int $id, string $director, string $prota)
    {
        $this->id = $id;
        $this->director = $director;
        $this->prota = $prota;
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
    public function getDirector(): string
    {
        return $this->director;
    }

    /**
     * @param string $director
     */
    public function setDirector(string $director): void
    {
        $this->director = $director;
    }

    /**
     * @return string
     */
    public function getProta(): string
    {
        return $this->prota;
    }

    /**
     * @param string $prota
     */
    public function setProta(string $prota): void
    {
        $this->prota = $prota;
    }

}