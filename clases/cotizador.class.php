<?php

require_once "conexion/conexion.php";
require_once "respuestas.class.php";

class cotizador extends conexion
{


    public function validaServicio($postBody)
    {

        $_respuestas = new respuestas;
        $dataDecode = json_decode($postBody, true); // Transformo en Array


        if (!isset($dataDecode['origen']) || !isset($dataDecode['peso']) || !isset($dataDecode['destino'])) {

            return $_respuestas->error_400();
        } else {

            $origen =  $dataDecode['origen'];
            $peso =    $dataDecode['peso'];
            $destino = $dataDecode['destino'];

            $datos = $this->valorEnvio($origen, $peso, $destino);


            if ($datos) {

                return $datos;
            } else {

                $_respuestas->error_200("No hubo resultados en el destino: " . $destino);
            }
        }
    }


    private function valorEnvio($origen, $peso, $destino)
    {

        $query = "SELECT
        t.VALOR AS valor
        FROM
        comunas c
        INNER JOIN tarifas t ON c.ID_ZONA = t.ID_ZONA
        WHERE 
        c.PUEBLO = '$destino' AND $peso BETWEEN t.KILOS_DESDE AND t.KILOS_HASTA";


        $datos = parent::obtenerDatos($query);


        if (isset($datos)) {

            return $datos;
            
        } else {

            return null;
            
        }
    }
}
