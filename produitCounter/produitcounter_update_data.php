<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: POST, GET");
    header('content-type: text/plain');  
    header("content-type: application/x-www-form-urlencoded");
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
    header("Access-Control-Max-Age: 172800");

    require("../connection_bd/connection_bd.php");

    // Get the posted data.
    $postdata = file_get_contents("php://input");
    
    if(isset($postdata) && !empty($postdata))
    {
      // Extract the data.
      $request = json_decode($postdata);

      if(isset($request->queryUpdateCounter)){
        
        $sql = $request->queryUpdateCounter;

        if($conn->query($sql)){
            http_response_code(201);
            echo json_encode(['data'=>'success']);
        }else
        {
          http_response_code(422);
        }
      }

    }
?>