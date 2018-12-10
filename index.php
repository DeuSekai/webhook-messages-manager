<?php

$method = $_SERVER['REQUEST_METHOD'];

// Process only when method is POST
if ($method == 'POST') {
    
    $requestBody = file_get_contents('php://input');
    $json        = json_decode($requestBody);
    
    $text = $json->queryResult->intent->displayName;
    
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
            //1 seconds delay
            sleep(1);
            $speech = "Hola, ¡feliz {$day}!, Podrías compartirnos tu nombre completo y de qué estado de la república nos contactas para brindarte un mejor servicio. 𝗧𝗲 𝗿𝗲𝗰𝗼𝗿𝗱𝗮𝗺𝗼𝘀 𝗾𝘂𝗲 𝗻𝘂𝗲𝘀𝘁𝗿𝗼𝘀 𝘁𝗿𝗮𝗺𝗶𝘁𝗲𝘀 𝘀𝗼𝗻 𝘁𝗼𝘁𝗮𝗹𝗺𝗲𝗻𝘁𝗲 𝗴𝗿𝗮𝘁𝘂𝗶𝘁𝗼𝘀 😊";
            break;
        
        default:
            //4 seconds delay
            sleep(4);
            $speech = NULL;
            break;
            
    }
    
    $response              = new \stdClass();
    $response->speech      = $speech;
    $response->displayText = $speech;
    $response->source      = "webhook";
    
    echo json_encode($response);
    
} else {
    
    echo "Method not allowed";
    
}

?>
