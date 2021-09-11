<?php


class respuestas{

    private $response = [
        'status' => 'Ok',
        'resut' => array()
    ];

 // Función para validar el Metodo de solicitud POST/GET...

 public function error_405(){

    $this->response['status'] = "error";  // Cambia el estado de Ok a error
    $this->response['result'] = array(
        "error_id" => "405",
        "error_msg" => "Metodo no permitido"
    );

    return $this->response;

 }


 // Función para validar la recepción de solicitud pero este mal dicha petición

 public function error_200($string = "Datos incorrectos"){  //s Se daclara la variable $string con un valor pero este es opcinal

    $this->response['status'] = "error";  // Cambia el estado de Ok a error
    $this->response['result'] = array(
        "error_id" => "200",
        "error_msg" => $string
    );

    return $this->response;

 }


 // Función para validar los datos enviados

 public function error_400(){ 

    $this->response['status'] = "error";  // Cambia el estado de Ok a error
    $this->response['result'] = array(
        "error_id" => "400",
        "error_msg" => "Datos incompletos o formato incorrecto"
    );

    return $this->response;

 }



}
