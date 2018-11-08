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
            $day = 60 * 60 * 24 + time(); // en un día
            $month = 60 * 60 * 24 * 30 + time(); // en un mes
            $year = 60 * 60 * 24 * 365 + time(); // en un año
            setcookie("nombre", $name);
            $speech = $name;
            break;
        
        default:
            if ($_COOKIE["nombre"] == NULL) {
                $speech = "No hay cookie";
            } else {
                $speech = $_COOKIE["nombre"];
            }
            //sleep(20);
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
