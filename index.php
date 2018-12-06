<?php

$method = $_SERVER['REQUEST_METHOD'];

// Process only when method is POST
if ($method == 'POST') {
    
    $requestBody = file_get_contents('php://input');
    $json        = json_decode($requestBody);
    
    $text = $json->result->metadata->intentName;
    
    switch ($text) {
        
        case 'Saludo inicial inbox':
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
            $speech = "Hola, ¡feliz {$day}!, Podrías compartirnos tu nombre completo y de qué estado de la república nos contactas para brindarte un mejor servicio. *Te recordamos que nuestros trámites son totalmente gratuitos* :)";
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
