<?php
//Creamos la clase multimedia que contendra el id de multimedia, la url de la imagen y en yt el trailer promocional
class multimedia
{

    private int $id;
    private string $url;
    private string $yt;

    /**
     * @param int $id
     * @param string $url
     * @param string $yt
     */
    public function __construct(int $id, string $url, string $yt)
    {
        $this->id = $id;
        $this->url = $url;
        $this->yt = $yt;
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
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    /**
     * @return string
     */
    public function getYt(): string
    {
        return $this->yt;
    }

    /**
     * @param string $yt
     */
    public function setYt(string $yt): void
    {
        $this->yt = $yt;
    }

}