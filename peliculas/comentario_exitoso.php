<?php
include_once "sql.php";

$dbo = new sql();
session_start();

if(isset($_POST['comentar'])){
    header("Location:main.php");
    $insert = $dbo->insertar_comentario($_SESSION['id_pelicula'], $_SESSION['id_usuario'], $_POST['comentario']);


}

?>
