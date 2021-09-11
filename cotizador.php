<?php

require_once "clases/cotizador.class.php";
require_once "clases/respuestas.class.php";

$_cotizador = new cotizador;

if ($_SERVER['REQUEST_METHOD'] ==  'POST') {

    $postBody = file_get_contents("php://input");

    $datosArray = $_cotizador->validaServicio($postBody);

    echo json_encode($datosArray, true);
    
} else {

    echo "Metodo no permitido";
    
}
