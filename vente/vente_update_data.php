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
        
        if(isset($request->queryAdd)){
            $sql = $request->queryAdd;

            if($conn->query($sql)){
              print json_encode(['data'=>'ajout reussie', 'status'=>'success']);
            }else{
              print json_encode(['data'=>'ajout non aboutit !', 'status'=>'error']);
            }
        }

        if(isset($request->queryUpdate)){
          $sql = $request->queryUpdate;

          if($conn->query($sql)){
            print json_encode(['data'=>'modification reussie', 'status'=>'success']);
          }else{
            print json_encode(['data'=>'modificatio non aboutit !', 'status'=>'error']);
          }
        }

        if(isset($request->queryDelete)){
          $sql = $request->queryDelete;

          if($conn->query($sql)){
            print json_encode(['data'=>'suppression reussie', 'status'=>'success']);
          }else{
            print json_encode(['data'=>'suppression non aboutit !', 'status'=>'error']);
          }
        }
    }

 ?>