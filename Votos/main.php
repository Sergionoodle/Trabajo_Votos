<?php

//incluimos las clases necesarias
include ("provincia.php");
include("resultado.php");
include ("partidos.php");

$api_url= "https://dawsonferrer.com/allabres/apis_solutions/elections/api.php?data=districts";
$api_url2 = "https://dawsonferrer.com/allabres/apis_solutions/elections/api.php?data=results";
$api_url3 = "https://dawsonferrer.com/allabres/apis_solutions/elections/api.php?data=parties";

$datosResultados = json_decode(file_get_contents($api_url2), true);
$datosProvincias = json_decode(file_get_contents($api_url ), true);
$datosPartidos = json_decode(file_get_contents($api_url3), true);


$provincias[] = array();

//Creamos los objetos con la array de provincias
function objetoProvincias($datosProvincias){
    for ($i = 0; $i < count($datosProvincias); $i++){
        $provincias[$i] = new provincia($datosProvincias[$i]['id'], $datosProvincias[$i]['name'], $datosProvincias[$i]['delegates']);
    }
    return $provincias;
}

$circuns[] = array();

//Creamos los objetos de la array de resultados
function objetosResultados($datosResultados){

    for ($i = 0; $i < count($datosResultados); $i++){
        $resultados[$i] = new resultado($datosResultados[$i]['district'], $datosResultados[$i]['party'], $datosResultados[$i]['votes']);
    }


    return $resultados;
}
$partido[] = array();

//Creamos los objetos de la array partidos
function objetoPartidos($datosPartidos){

    for ($i = 0; $i < count($datosPartidos); $i++){
        $partido[$i] = new partidos($datosPartidos[$i]['id'], $datosPartidos[$i]['name'], $datosPartidos[$i]['acronym'], $datosPartidos[$i]['logo']);
    }
    return $partido;
}

//Asignamos a cada uno una variable
$partidosOb = objetoPartidos($datosPartidos);
$resultadosOb = objetosResultados($datosResultados);
$provinOb = objetoProvincias($datosProvincias);

//filtramos por partidos
function filtroPartidos($nombrePartido){
    global  $partidosOb;
    $datosFiltro[] = Array();
    $contador = 0;
    for ($i = 0; $i < count($partidosOb); $i++ ){
        if($partidosOb[$i]->getNombre() == $nombrePartido){
            $datosFiltro[$contador] = $partidosOb[$i];
            $contador++;
        }
    }
    return $datosFiltro;
}

//Calculamos los escaños
function calculoEscanos($nomProvin, $delegados){
    $datosFiltro[] = Array();
    $contador = 0;
    global $resultadosOb;

    //Metemos los datos en un filtro
    for ($i = 0; $i < count($resultadosOb); $i++){
        if($resultadosOb[$i]->getDistrito() == $nomProvin){
            $datosFiltro[$contador] = $resultadosOb[$i];
            $contador++;
        }
    }


    //asignamos
    for ($j = 0; $j < $delegados; $j++){//escaños
        $mayor = 0;
        for ($x = 0; $x < count($datosFiltro); $x++){//partidos
            if($datosFiltro[$x]->getVotos()/$datosFiltro[$x]->getDivisor() > $datosFiltro[$mayor]->getVotos()/$datosFiltro[$mayor]->getDivisor()){
                $mayor = $x;
            }
        }
        $aumentoDiv = $datosFiltro[$mayor]->getDivisor()+1;
        $aumentoEscanos = $datosFiltro[$mayor]->getEscanos()+1;
        $datosFiltro[$mayor]->setDivisor($aumentoDiv);
        $datosFiltro[$mayor]->setEscanos($aumentoEscanos);
    }


}

//Funcion a ejecutar para hacer los escaños
function hacerEscanos($provinOb){

    for ($i = 0; $i < count($provinOb); $i++){

        calculoEscanos($provinOb[$i]->getNomProv(), $provinOb[$i]->getDelegados());

    }
}

hacerEscanos($provinOb);

//Mapeamos para conseguir los totales de Votos y escaños
function mapeo(){

    global $partidosOb;
    global $resultadosOb;

    for ($i = 0; $i < count($partidosOb); $i++){
        $escanosTotales = 0;
        $votosTotales = 0;

        for ($j = 0; $j < count($resultadosOb); $j++){

            if ($partidosOb[$i]->getNombre() == $resultadosOb[$j]->getPartido()){

                $escanosTotales += $resultadosOb[$j]->getEscanos();
                $votosTotales += $resultadosOb[$j]->getVotos();

            }

        }
        $partidosOb[$i]->setTotalVotos($votosTotales);
        $partidosOb[$i]->setTotalEscanos($escanosTotales);
    }

}

mapeo();

?>

<html>
<head>
    <title>Election Results</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        table, th, td {
            border: 1px solid black;
            padding-left: 12px;
            padding-right: 12px;
        }
        img{
            height: 25px;
        }
    </style>
</head>
<body>
<form action="main.php" method="post">
    <?php
//Primer formulario donde podemos elegir lo que queremos ver
    echo '<select name="porOrdenar">';
    echo '<option value="ordenProvincias">Ordenar por Provincias</option>';
    echo '<option value="ordenParty">Ordenar por Partidos</option>';
    echo '<option value="generalOrder">General</option>';
    echo '</select>';

//No consegui hacer que se quedase con lo que escogias
    echo '<input type="submit" value="Elección">';
    echo "Recuerda seleccionar esta casilla en cada busqueda.";

    if(isset($_POST['porOrdenar'])){
        $sort = strval($_POST['porOrdenar']);
    }

//Condicion para cuando escojas ordenar por provincias
    if($sort == 'ordenProvincias') {

//Formulario de la tabla de provincias

        echo '<br>';
        echo '<select name="sorting">';
        for ($i = 0; $i < count($provinOb); $i++) {
            echo '<option value="' . $provinOb[$i]->getNomProv() . '">' . $provinOb[$i]->getNomProv() . '</option>';
        }
        echo '</select>';
        if (isset($_POST["sorting"])) {
            $sortby = strval($_POST["sorting"]);
        }
        echo '<input type="submit" value="Filtra">';

//RESULTADO DE ORDENAR X PROVINCIAS
        echo '<table>';
        echo '<tbody>';
        echo '<tr><th>Circumscripción</th><th>Partido</th><th>Votos</th><th>Escaños</th></tr>';
        for ($i = 0; $i < count($resultadosOb); $i++) {

            if ($resultadosOb[$i]->getDistrito() == $sortby) {
                echo '<tr>
                        <td>' . $resultadosOb[$i]->getDistrito() . '</td>
                        <td>' . $resultadosOb[$i]->getPartido() . '</td>
                        <td>' . $resultadosOb[$i]->getVotos() . '</td>
                        <td>' . $resultadosOb[$i]->getEscanos() . '</td>
                        </tr>';
            }

        }
        echo '</tbody>';
        echo '</table>';

//Condicion para cuando escojas ordenar por partido
    }elseif ($sort == 'ordenParty') {

        echo '<br>';

//Formulario de ordenar por partido
        echo '<select name="sortPartidos">';
        for ($i = 0; $i < count($partidosOb); $i++) {
            echo '<option value="' . $partidosOb[$i]->getNombre() . '">' . $partidosOb[$i]->getNombre() . '</option>';
        }
        echo '</select>';
        if (isset($_POST["sortPartidos"])) {
            $sortbyP = strval($_POST["sortPartidos"]);
        }
        echo '    <input type="submit" value="partidos">';


//Resultado de ordenar por partido
        $filtroParty = filtroPartidos($sortbyP);
        echo '<table>';
        echo '<tbody>';
        echo '<tr><th>Circumscripción</th><th>Partido</th><th>Votos</th><th>Escaños</th></tr>';


            for ($i = 0; $i < count($resultadosOb); $i++) {

                if ($resultadosOb[$i]->getPartido() == $sortbyP) {
                    echo '<tr>';
                    echo '<td>' . $resultadosOb[$i]->getDistrito() . '</td>';
                    echo '<td><img src=' . $filtroParty[0]->getLogo(). '>' . ' ' . $resultadosOb[$i]->getPartido() . '</td>';
                    echo '<td>' . $resultadosOb[$i]->getVotos();
                    echo '</td>';
                    echo '<td>' . $resultadosOb[$i]->getEscanos() . '</td>';
                    echo '</tr>';
                }

            }

        echo '</tbody>';
        echo '</table>';

//Condicion si escojes la opcion de general
    }elseif($sort == 'generalOrder') {

//Resultado de ordenar por general
        echo '<br>';
        echo '<table>';
        echo '<tbody>';
        echo '<tr><th>Circumscripción</th><th>Partido</th><th>Votos</th><th>Escaños</th></tr>';

    for ($i = 0; $i < count($partidosOb); $i++) {

                echo '<tr>';
                echo '<td>General</td>';
                echo '<td><img src=' . $partidosOb[$i]->getLogo() . '>' . ' ' . $partidosOb[$i]->getAcronimo() . '</td>';
                echo '<td>';
                echo $partidosOb[$i]->getTotalVotos();
                echo '</td>';
                echo '<td>'.$partidosOb[$i]->getTotalEscanos().'</td>';
                echo '</tr>';
            }
        }
    ?>
</form>
</body>
</html>