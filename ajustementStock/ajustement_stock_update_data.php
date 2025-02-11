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
    
      if(isset($request->queryAddAjustement)){
        
        $sql = $request->queryAddAjustement;

        if($conn->query($sql)){
            http_response_code(201);
            echo json_encode(['data'=>'insertion réussie !']);
        }else
        {
          http_response_code(422);
        }
      }

      if(isset($request->queryUpdateAjustement)){
        
        $sql = $request->queryUpdateAjustement;

        if($conn->query($sql)){
            http_response_code(201);
            echo json_encode(['data'=>'success']);
        }else
        {
          http_response_code(422);
        }
      }
      //queryDeleteProduit
      
      if(isset($request->queryDeleteAjustement)){
        $sql = $request->queryDeleteAjustement;

        if($conn->query($sql)){
            http_response_code(201);
            echo json_encode(['data'=>'suppression réussie']);
        }else
        {
          http_response_code(422);
        }
      }

    }
?>