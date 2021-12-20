<?php
include_once "sql.php";

$dbs = new sql();
session_start();

if(isset($_POST['passwd'])&& isset($_POST['email'])) {


    $datos_usuario = $dbs->usuario_logeado($_POST['email']);
    $pass_verificada = password_verify($_POST['passwd'], $datos_usuario->getPassword());
    if($pass_verificada == true){
       echo "Logeado con exito";
        $_SESSION['logeado'] = true;
        $_SESSION['id_usuario'] = $datos_usuario->getId();
        header("Location:main.php ");
    }else{
        echo "Tienes un error en el login, te has equivocado de contraseña o usuario";
        echo "<br><a href='formulario_loggin.php'>Vuelve a intentarlo</a>";
        echo "<br><a href='formulario_register.php'>Registrate Aqui</a>";
        echo "<br><a href='main.php'>Vuelve a IMDBB a disfrutar</a>";
    }

}
else {

    echo $_POST["passwd"];
    echo $_POST["email"];
}

?>