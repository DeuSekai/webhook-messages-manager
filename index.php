<?php
function processMessage($update) {
    if($update["queryResult"]["action"] == "input.welcome"){
              $week = array(
            "Domingo",
            "Lunes",
            "Martes",
            "Miercoles",
            "Jueves",
            "Viernes",
            "Sábado"
        );
        $day  = $week[date('w')];
        //1 seconds delay
        sleep(1);
        sendMessage(array(
            "source" => $update["responseId"],
            "fulfillmentText"=>"Hola, ¡feliz {$day}!, Podrías compartirnos tu nombre completo y de qué estado de la república nos contactas para brindarte un mejor servicio. 𝗧𝗲 𝗿𝗲𝗰𝗼𝗿𝗱𝗮𝗺𝗼𝘀 𝗾𝘂𝗲 𝗻𝘂𝗲𝘀𝘁𝗿𝗼𝘀 𝘁𝗿𝗮𝗺𝗶𝘁𝗲𝘀 𝘀𝗼𝗻 𝘁𝗼𝘁𝗮𝗹𝗺𝗲𝗻𝘁𝗲 𝗴𝗿𝗮𝘁𝘂𝗶𝘁𝗼𝘀 😊",
            "payload" => array(
                "items"=>[
                    array(
                        "simpleResponse"=>
                    array(
                        "textToSpeech"=>"response from host"
                         )
                    )
                ],
                ),
           
        ));
    }else if($update["queryResult"]["action"] == "convert"){
        if($update["queryResult"]["parameters"]["outputcurrency"] == "USD"){
           $amount =  intval($update["queryResult"]["parameters"]["amountToConverte"]["amount"]);
           $convertresult = $amount * 360;
        }
         sendMessage(array(
            "source" => $update["responseId"],
            "fulfillmentText"=>"The conversion result is".$convertresult,
            "payload" => array(
                "items"=>[
                    array(
                        "simpleResponse"=>
                    array(
                        "textToSpeech"=>"The conversion result is".$convertresult
                         )
                    )
                ],
                ),
           
        ));
    }else{
        sendMessage(array(
            "source" => $update["responseId"],
            "fulfillmentText"=>"Error",
            "payload" => array(
                "items"=>[
                    array(
                        "simpleResponse"=>
                    array(
                        "textToSpeech"=>"Bad request"
                         )
                    )
                ],
                ),
           
        ));
        
    }
}
 
function sendMessage($parameters) {
    echo json_encode($parameters);
}
 
$update_response = file_get_contents("php://input");
$update = json_decode($update_response, true);
if (isset($update["queryResult"]["action"])) {
    processMessage($update);
    
}else{
            //4 seconds delay
        sleep(4);
     sendMessage(array(
            "source" => $update["responseId"],
            "fulfillmentText"=>NULL,
            "payload" => array(
                "items"=>[
                    array(
                        "simpleResponse"=>
                    array(
                        "textToSpeech"=>"Bad request"
                         )
                    )
                ],
                ),
           
        ));
}


?>
