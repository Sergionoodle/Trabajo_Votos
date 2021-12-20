<?php
//incluimos todas las clases
include_once "principal.php";
include_once "staff.php";
include_once "sql.php";
include_once "multimedia.php";

//creamos la conexion de la base de datos
$dbo = new sql();
//$principales = $dbo->getprincipal();



?>

<head>
    <title>SUPERIMDB</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        .col-md-4{
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: center;
            width: 100%;
            background:linear-gradient(211deg, rgba(131,58,180,1) 42%, rgba(29,92,253,1) 78%);

        }

        .card-body{
            background-color: rgba(18, 47, 234, 0.18);
        }
        .mb-4{
            width: 300px;
            height: auto;
            margin:20px;

        }
        .estrella{
            width: 25px;
            height: 25px;
        }

        .card-img-top{
            width: 100%;
            height: 300px;
        }
        .cabecera{
            background-color: rgba(40, 10, 75, 0.96);
            height: 50px;
        }
        .h1{
            color: white;
            text-align: center;
        }

        hr{
            background-color: blueviolet;
        }

        .buscadorazo{
            position: absolute;
            margin-top: 10px;
            margin-left: 5px;
        }
        .buscador{
            width: 100px;
        }
        .orden{

            position: absolute;
            margin-top: 10px;
            margin-left: 80%;

        }
        .btn{
            background-color: black;
            color: white;
            height: 35px;
        }

        .loggin_register{
            position: absolute;
            margin-top: 10px;
            margin-left: 15%;
        }
        .cerrar{
            background-color: white;
            height: 30px;
            width: 150px;
            position: absolute;
            top: 40px;
            left: 1%;
            border: #111111 solid 3px;
        }
        .cerrado:link, .cerrado:visited,.cerrado:active{
            text-decoration: none;
            color: black;

        }

    </style>
</head>

<body>

<div class="cabecera">
    <div class="loggin_register">
        <form action="formulario_register.php" method="get">
            <input type="submit" name="loggin" value="Entra YA!">
        </form>
    </div>
    <div class="buscadorazo">
        <form action="main.php" method="get">
            <input class="buscador" type="text" name="busqueda">
            <input type="submit" name="enviar" value="Buscar">
        </form>
        <?php


        if(isset($_GET['enviar'])){
            $busqueda = $_GET['busqueda'];

            $principales = $dbo->getPeliBusqueda($busqueda);
        }else{
            $principales = $dbo->getprincipal();
        }
        ?>
    </div>
    <div class="orden">
        <form action="main.php">
            <select name="ordenar" id="ordenador">
                <option value="unsorted">Por defecto</option>
                <option value="nombre">Por Titulo</option>
                <option value="mejor">Mejor Puntuacion</option>
            </select>
            <button class="btn" type="submit">Ordenar</button>
        </form>
        <?php
        if (isset($_GET['ordenar'])){
            if($_GET['ordenar'] == "unsorted"){
                $principales = $dbo->getprincipal();
            }elseif($_GET['ordenar'] == 'nombre'){
                $principales = $dbo->ordenTitulo();
            }elseif($_GET['ordenar'] == 'mejor'){
                $principales = $dbo->mejorPuntos();
            }
        }
        ?>
    </div>
    <div class="cerrar">
        <a class="cerrado" href="cerrar.php">Cerrar Sesion</a>
    </div>
    <h1 class="h1">Ifinity Movies Dont Be Moved <?php
        session_start();//Entramos en la sesion
        if($_SESSION['logeado']){
            echo "/// Estas Logeado";
        }else{
            echo "/// NO estas Logeado";
        } ?>
    </h1>

</div>


<div class="col-md-4 ">
    <?php foreach ($principales as $principal){ ?>

        <div class="card mb-4 box-shadow bg-light">

            <a href="paginaextendida.php?id=<?php echo $principal->getIdMultimedia()->getId(); ?>"><img class="card-img-top" src="<?php echo $principal->getIdMultimedia()->getUrl()?>" alt="imagen"></a>
            <div
                    class="card-body">
                <h5 class="card-title"><?php echo $principal->getTitulo()?></h5>
                <hr style="height: 5px">
                <div class="mb-3" style="margin-bottom:0!important;"><label for="exampleInputEmail1" class="form-label" style="margin-bottom: 0;"><strong>Genero:</strong></label>
                    <div id="emailHelp" class="form-text" style="margin-top:0;"><?php echo $principal->getGenero()?></div>
                </div>
                <div class="mb-3"><label for="exampleInputEmail1" class="form-label" style="margin-bottom: 0;"><strong>Puntuacion:</strong></label><div id="emailHelp" class="form-text" style="margin-top:0"></div>
                    <div id="emailHelp" class="form-text" style="margin-top:0;"><?php echo $principal->getPuntuacion()?><?php if($principal->getPuntuacion() <= 5){
                            echo '<img class="estrella" src="img/rojo.png">';
                        }else{echo '<img class="estrella" src="img/pngegg.png">';}?></div>
                </div>
                <div class="descripcion"><strong>Descripcion</strong>
                    <div id="descripcionentera" class="form-text" style="margin-top:0;"><?php echo $principal->getDescripcion()?></div>
                </div>
            </div>

        </div>

    <?php } ?>

</div>






</body>