<?php

$method = $_SERVER['REQUEST_METHOD'];

// Process only when method is POST
if ($method == 'POST') {
    
    $requestBody = file_get_contents('php://input');
    $json        = json_decode($requestBody);
    
    $intent = $json->result->metadata->intentName;
    
    switch ($intent) {
        
        case 'Préstamo':
            $name = $json->result->parameters->any;
            $caducidad = 60 * 60 * 24 * 30 + time();
            setcookie("nombre", $name, $caducidad);
            $speech = $name;
            break;
        
        default:
            If (isset($_COOKIE["nombre"])) {
                $speech = $_COOKIE["nombre"];
            } else {
                $speech = " Parece que no pasó por la pagina inicial.";
            }
            break;
            
    }
    
    $response              = new \stdClass();
    $response->speech      = $speech;
    $response->displayText = $speech;
    $response->source      = "webhook";
    
    sleep(2);
    
    echo json_encode($response);
    
} else {
    
    echo "Method not allowed";
    
}

?> 
