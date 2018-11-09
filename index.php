<?php

$method = $_SERVER['REQUEST_METHOD'];

// Process only when method is POST
if ($method == 'POST') {
  
    $response              = new \stdClass();
    $speech = NULL;
    $response->speech      = $speech;
    $response->displayText = $speech;
    $response->source      = "webhook";
    
    //2 seconds delay
    sleep(3);
    
    echo json_encode($response);
    
} else {
    
    echo "Method not allowed";
    
}

?> 
