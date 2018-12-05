<?php

$method = $_SERVER['REQUEST_METHOD'];

// Process only when method is POST
if ($method == 'POST') {
    
    $requestBody = file_get_contents('php://input');
    $json        = json_decode($requestBody);
    
    $text = $json->result->metadata->intentName;
    
    switch ($text) {
        
        case 'Default Welcome Intent':
            $week   = array(
                "Domingo",
                "Lunes",
                "Martes",
                "Miercoles",
                "Jueves",
                "Viernes",
                "Sábado"
            );
            $day    = $week[date('w')];
            $speech = "¡Feliz {$day}!\n\nDeja te platico sobre nuestros préstamos :D\n\nNuestros préstamos son para jubilados y pensionados, trabajadores del sector salud, de la educación y del gobierno.\n\nNuestros requisitos son:\n\n1.- Identificación oficial\n2.- Comprobante de domicilio\n3.- Comprobante de ingresos\n\n¡En Préstamo Feliz no necesitas aval además de que no checamos buró!\n\nTe recordamos que nuestros tramites son totalmente gratuitos.";
            break;
        
        default:
            $speech = NULL;
            break;
            
    }
    
    $response              = new \stdClass();
    $response->speech      = $speech;
    $response->displayText = $speech;
    $response->source      = "webhook";
    
    //4 seconds delay
    sleep(4);
    
    echo json_encode($response);
    
} else {
    
    echo "Method not allowed";
    
}

?>
