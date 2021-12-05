<?php
//Incluimos la clase principal, staff y multimedia
include_once "principal.php";
include_once "staff.php";
include_once "multimedia.php";

//Extendemos la clase de mysqli
class sql extends mysqli{

    //damos los valores
    private string $hostname = "localhost";
    private string $username = "root";
    private string $password = "";
    private string $database = "peliculas";

    //hacemos que la funcion default llame a la funcion local
    public function default(){
        $this->local();
    }

    //la funcion local llama a los constructores para iniciar sesion
    public function local(){
        //lo que inicia sesion viene extendido de mysqli
        parent::__construct($this->hostname,$this->username,$this->password,$this->database);

        //Por si hay algun error
        if (mysqli_connect_error()){
            die("ERROR DATABASE".mysqli_connect_error());
        }
    }

    //hacemos una funcion para conseguir lo que queremos de la pagina principal (to_do el contenido que luego recorreremos para printarlo)
    public function getprincipal(){

        //Primer bloque, hacemos la select
        $sql = "SELECT * FROM principal ";
        $this->default();
        $query = $this->query($sql);
        $this->close();//cerramos conexion
        $return = Array();
        while($resultado = $query->fetch_assoc()) {//hacemos que sea una array asociativa
            $return[] = new principal($resultado['id'], $this->getMultimedia($resultado['idMultimedia']), $resultado['titulo'], $resultado['genero'], $resultado['puntuacion'], $this->getStaff($resultado['idStaff']), $resultado['descripcion']);
        }
        return $return;

    }

    //Creamos una funcion que mediante un id saquemos los objetos multimedia deseados
    public function getMultimedia($id)
    {
        $sql = "SELECT * FROM multimedia WHERE id =".$id;
        $this->default();
        $query = $this->query($sql);
        $this->close();//cerramos conexion
        $resultado = $query->fetch_assoc();//hacemos que sea una array asociativa
        $return = new multimedia($resultado['id'], $resultado['url'], $resultado['yt']);//Creamos el objeto de multimedia
        return $return;

    }

    //Creamos una funcion que mediante el id saque el staff deseado
    public function getStaff($id)
    {
        $sql = "SELECT * FROM staff WHERE id =".$id;
        $this->default();
        $query = $this->query($sql);
        $this->close();//cerramos conexion
        $resultado = $query->fetch_assoc();//hacemos que sea una array asociativa
        $return = new staff($resultado['id'], $resultado['director'], $resultado['prota']);

        return $return;
    }

    //Creamos una funcion que mediante el id que le metemos, saquemos lo necesitado con multimedia
    public function getIdPrincipal($id){
        $sql = "SELECT * FROM principal WHERE idMultimedia =".$id;
        $this->default();
        $query = $this->query($sql);
        $this->close();//cerramos conexion
        $resultado = $query->fetch_assoc();//hacemos que sea una array asociativa
        $return = new principal($resultado['id'], $this->getMultimedia($resultado['idMultimedia']), $resultado['titulo'], $resultado['genero'], $resultado['puntuacion'], $this->getStaff($resultado['idStaff']), $resultado['descripcion']);

        return $return;
    }

    //funcion para buscador
    public function getPeliBusqueda($busqueda){
        $sql = "SELECT * FROM principal WHERE titulo LIKE '%".$busqueda."%';";
        $this->default();
        $query = $this->query($sql);
        $this->close();//cerramos conexion
        $return = Array();
        while($resultado = $query->fetch_assoc()) {//hacemos que sea una array asociativa
            $return[] = new principal($resultado['id'], $this->getMultimedia($resultado['idMultimedia']), $resultado['titulo'], $resultado['genero'], $resultado['puntuacion'], $this->getStaff($resultado['idStaff']), $resultado['descripcion']);
        }
        return $return;
    }

    //Funcion ordenar por titulo
    public function ordenTitulo(){

        //Primer bloque, hacemos la select
        $sql = "SELECT * FROM principal ORDER BY titulo";
        $this->default();
        $query = $this->query($sql);
        $this->close();//cerramos conexion
        $return = Array();
        while($resultado = $query->fetch_assoc()) {//hacemos que sea una array asociativa
            $return[] = new principal($resultado['id'], $this->getMultimedia($resultado['idMultimedia']), $resultado['titulo'], $resultado['genero'], $resultado['puntuacion'], $this->getStaff($resultado['idStaff']), $resultado['descripcion']);
        }
        return $return;

    }

    //Funcion ordenar por mejor puntos
    public function mejorPuntos(){

        //Primer bloque, hacemos la select
        $sql = "SELECT * FROM principal ORDER BY puntuacion DESC ";
        $this->default();
        $query = $this->query($sql);
        $this->close();//cerramos conexion
        $return = Array();
        while($resultado = $query->fetch_assoc()) {//hacemos que sea una array asociativa
            $return[] = new principal($resultado['id'], $this->getMultimedia($resultado['idMultimedia']), $resultado['titulo'], $resultado['genero'], $resultado['puntuacion'], $this->getStaff($resultado['idStaff']), $resultado['descripcion']);
        }
        return $return;

    }
}


?>
