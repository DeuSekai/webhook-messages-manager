<?php

$method = $_SERVER['REQUEST_METHOD'];

// Process only when method is POST
if ($method == 'POST') {
    
    $requestBody = file_get_contents('php://input');
    $json        = json_decode($requestBody);
    
    $intent = $json->result->metadata->intentName;
    
    switch ($intent) {
            
        case 'Default Welcome Intent':
            if ($_COOKIE["cookie"] == NULL) {
                $speech = "Hola, ¿en qué puedo ayudarte?";
            } else {
                $valor = $_COOKIE["cookie"];
                $speech = "Hola {$valor}, ¿en qué puedo ayudarte?";
            }
            break;
         
        case 'Perfil inválido':
            if ($_COOKIE["cookie"] == NULL) {
                $speech = NULL;
            } else {
                $valor = $_COOKIE["cookie"];
                $speech = "Lo sentimos mucho {$valor} pero por el momento solo otorgamos préstamos a personas que cumplen con este perfil.\n¡Pero no te preocupes! Pronto nos pondremos en contacto con una empresa hermana para ayudarte a cumplir con lo que necesitas y ellos se comunicarán contigo :)\nPor favor deja en el siguiente mensaje tu nombre completo y un número de contacto para poder comunicarnos contigo :)";
            }
            break;
        
        case 'Préstamo':
            $name = $json->result->parameters->any;
            //$day = 60 * 60 * 24 + time(); // en un día
            //$month = 60 * 60 * 24 * 30 + time(); // en un mes
            //$year = 60 * 60 * 24 * 365 + time(); // en un año
            
            setcookie("cookie", $name/*,$month*/);
            $speech = NULL;
            break;
        
        default:
            $speech = NULL;
            break;
            
    }
    
    $response              = new \stdClass();
    $response->speech      = $speech;
    $response->displayText = $speech;
    $response->source      = "webhook";
    
    sleep(3);
    
    echo json_encode($response);
    
} else {
    
    echo "Method not allowed";
    
}

?> 
