<?php

class conexion
{

    private $server;
    private $user;
    private $password;
    private $database;
    private $port;
    private $conexion;

    public function __construct()
    {
        $listaDatos = $this->datosConexion();

        //Recorremos el array de conexion

        foreach ($listaDatos as $key => $value) {

            $this->server =      $value['server'];
            $this->user =        $value['user'];
            $this->password =    $value['password'];
            $this->database =    $value['database'];
            $this->port =        $value['port'];
        }

        $this->conexion = new mysqli($this->server, $this->user, $this->password, $this->database,  $this->port);

        //Problemas de conexion
        if ($this->conexion->connect_errno) {

            echo "Hubo un problema en la conexión de la BD";
            die(); //Para no ejecutar nada más

        }
    }


    private function datosConexion()
    {

        $path = dirname(__FILE__);
        $jsonData = file_get_contents($path . "/" . "config");  // Abre el archivo: config y lo retorna
        return json_decode($jsonData, true); //Convierte en un array asociativo Json de config

    }

    // Función para convertir la respuesta de la base de datos en UTF8, quitar tildes/Caracteres especiales.
    private function convertirUTF8($array)
    {
        array_walk_recursive($array, function (&$item, $key) {    // &$item: se indica que es por referencia

            if (!mb_detect_encoding($item, 'UTF8', true)) { // Pregunta sino detecta caracteres especiales

                $item = utf8_encode($item);
            }
        });

        return $array;
    }

    //Metodo para obtener datos  de la BD
    public function obtenerDatos($query)
    {

        $result = $this->conexion->query($query);

        $resultArray = array();

        foreach ($result as $key) {

            $resultArray[] = $key;  //Similar al PUT
            
        }

        return $this->convertirUTF8($resultArray);  //
    }

    // Metodo para Guardar Datos en la BD
    public function nonQuery($query)
    {

        $result = $this->conexion->query($query);
        return $this->conexion->affected_rows;
        
    }

    // Metodo para guardar y el mismo retorna el Id de la ultima fila que insertamos.
    public function nonQueryId($query)
    {

        $result = $this->conexion->query($query);
        $filas = $this->conexion->affected_rows;

        if ($filas >= 1) {

            return $this->conexion->insert_id; //Retorna el Id que insertamos

        } else {

            return 0;
        }
    }
}
