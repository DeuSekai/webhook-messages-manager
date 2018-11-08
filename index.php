<?php

$method = $_SERVER['REQUEST_METHOD'];

// Process only when method is POST
if ($method == 'POST') {
    
    $name = "Amigo";
    
    $requestBody = file_get_contents('php://input');
    $json = json_decode($requestBody);
    
    $intent = $json->result->metadata->intentName;
   
    switch ($intent) {
        
        case 'Préstamo': 
            global $name = $json->result->parameters->any;
			$speech = $name;
			break;

		default:
			$speech = $name;
			break;
            
	}
    
    $response = new \stdClass();
    $response->speech= $speech;
    $response->displayText = $speech;
    $response->source = "webhook";
    
    sleep(2);
    
    echo json_encode($response);
    
} else {
    
    echo "Method not allowed";

}

?> 
