<?php

$method = $_SERVER['REQUEST_METHOD'];

// Process only when method is POST
if ($method == 'POST') {
    
    $requestBody = file_get_contents('php://input');
    $json        = json_decode($requestBody);
    
    sleep(5);
    
    $speech = "Primer mensaje";
    
    $response              = new \stdClass();
    $response->speech      = $speech;
    $response->displayText = $speech;
    $response->source      = "webhook";
    
    echo json_encode($response);
    
    sleep(5);
    
    $speech2 = "Segundo mensaje";
    
    $response->speech      = $speech2;
    $response->displayText = $speech2;
    
    echo json_encode($response);
    
} else {
    
    echo "Method not allowed";

}

?> 
