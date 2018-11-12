<?php

$method = $_SERVER['REQUEST_METHOD'];

// Process only when method is POST
if ($method == 'POST') {
  
    $response              = new \stdClass();
    $response->speech      = NULL;
    $response->displayText = NULL;
    $response->source      = "webhook";
    
    //4 seconds delay
    sleep(4);
    
    echo json_encode($response);
    
} else {
    
    echo "Method not allowed";
    
}

?> 
