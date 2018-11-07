<?php

$method = $_SERVER['REQUEST_METHOD'];

// Process only when method is POST
if ($method == 'POST') {
    
    $requestBody = file_get_contents('php://input');
    $json = json_decode($requestBody);
    
    $speech = "Primer mensaje";
    
    $response = new \stdClass();
    $response->speech= $speech;
    $response->displayText = $speech;
    $response->source = "webhook";
    
    sleep(1);
    
    echo json_encode($response);
    
} else {
    
    echo "Method not allowed";

}

?> 
