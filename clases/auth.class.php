<?php

require_once "conexion/conexion.php";
require_once "respuestas.class.php";

class auth extends conexion{


    public function login($json){

        $_respuestas = new respuestas;
        $dataDecode = json_decode($json, true); // Decodifica y transforma en Array asociativo

        if(!isset($dataDecode['usuario']) || !isset($dataDecode['password'])){

            //error con los campos
            return $_respuestas->error_400();

        }else{

            // todo bien
            $usuario = $dataDecode['usuario'];
            $password = $dataDecode['password'];


        }


    }

    private function obtenerDatosUsuario(){

        $query = "SELECT ";



    }


    
}