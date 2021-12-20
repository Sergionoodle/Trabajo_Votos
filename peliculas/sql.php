<?php
//Incluimos la clase principal, staff y multimedia
include_once "principal.php";
include_once "staff.php";
include_once "multimedia.php";
include_once "usuarios.php";
include_once "comentarios.php";
include_once "join_user.php";

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

    public function insertar_usuarios($email, $password, $usuario){
        $sql = "INSERT INTO usuarios (email, password, usuario) VALUES ('".$email."','".$password."','".$usuario."');";
        $this->default();


        if (!mysqli_query($this,$sql)){
            //Imprimimos el alert
            echo '<script>alert("Email ya registrado, introduce otro email");
    //Con esta linea de javascript redireccionamos al usuario en este caso a la misma pagina. 
            location.href="http://localhost/html/SJimenez/PhpSQL/peliculas/formulario_register.php?loggin=Entra+YA%21";
                    </script>';
        }
        $this->close();
    }

    public function usuario_logeado($usuario)
    {
        $sql = "SELECT * FROM usuarios where email='".$usuario."';";
        $this->default();
        $query = $this->query($sql);
        $resultado = $query->fetch_assoc();//hacemos que sea una array asociativa
        $this->close();
        $return = new usuarios($resultado['id'], $resultado['email'], $resultado['password'], $resultado['usuario']);
        return $return;

    }

    public function insertar_comentario($id_pelicula, $id_usuario, $comentario)
    {
        $sql = "INSERT INTO comentarios (idUsuario, idPelicula, comentario) VALUES (".$id_usuario.",".$id_pelicula.",'".$comentario."');";
        $this->default();
        $query = $this->query($sql);
        $resultado = $query->fetch_assoc();
        $this->close();
        $return = new comentarios($resultado['id'], $resultado['idUsuario'], $resultado['idPelicula'],$resultado['comentario']);
        return $return;
    }

    public function imprimir_comentarios($id){
        $sql = "SELECT * FROM comentarios WHERE idPelicula =".$id.";";
        $this->default();
        $query = $this->query($sql);
        $this->close();
        $return = Array();

        while($resultado = $query->fetch_assoc()) {//hacemos que sea una array asociativa

            $return[] = new comentarios($resultado['id'],$resultado['idUsuario'],$resultado['idPelicula'],$resultado['comentario']);
        }
        return $return;

    }

    public function imprimir_usuario($id){
        $sql = "SELECT u.usuario FROM comentarios c INNER JOIN usuarios u ON (c.idUsuario = u.id) WHERE idPelicula =".$id.";";
        $this->default();
        $query = $this->query($sql);
        $this->close();//cerramos conexion
        $return = Array();
        while($resultado = $query->fetch_assoc()) {//hacemos que sea una array asociativa
            $return[] = new join_user($resultado['usuario']);
        }
        return $return;

    }

}


?>