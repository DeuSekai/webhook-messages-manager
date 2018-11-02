<?php

$method = $_SERVER['REQUEST_METHOD'];

// Process only when method is POST
if ($method == 'POST') {
    $requestBody = file_get_contents('php://input');
    $json        = json_decode($requestBody);
    
    sleep(20);
    
    $speech = "Hi, Nice to meet you";
    $speech2 = "Hi, Nice to meet you";
    
    $response              = new \stdClass();
    $response->speech      = $speech;
    $response->displayText = $speech;
    $response->source      = "webhook";
    echo json_encode($response);
    
    sleep(20);
    
    echo json_encode($response);
    
} else {
    echo "Method not allowed";
}

?> 
