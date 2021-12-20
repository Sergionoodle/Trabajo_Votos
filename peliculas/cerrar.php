<?php
//Con esto cerramos sesion
session_start();

$_SESSION['login'] = false;//Hacemos que la sesion se cierre

session_destroy();//Destruimos la sesion

//Nos vamos al main otra vez
header("Location:main.php ");

echo "Has cerrado la conexion con exito --> <a href='main.php'>Vuelve a la pagina principal</a>"
?>