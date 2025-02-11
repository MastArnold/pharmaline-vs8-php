<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: POST, GET");
    header('content-type: text/plain');  
    header("content-type: application/x-www-form-urlencoded");
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
    header("Access-Control-Max-Age: 172800");

    require_once "../connection_bd/conn_pdo.php";
    require "model/assurance.php";

    $postdata = file_get_contents("php://input");
    
    if(isset($postdata) && !empty($postdata)){
        //echo "Connected successfully";
        try{
            $data = json_decode($postdata);
            $values = $data->values;

            $stmt = $pdo->prepare(Assurance::get_select_search_query_prepared());
            $stmt->execute(Assurance::get_select_search_values_prepared($values));

            $results = $stmt->fetchAll();

            if(count($results) > 0){
                print json_encode(["results"=>$results, "status"=>"success"]);
            }else{
                print json_encode(["results"=>[], "status"=>"success"]);
            }
        } catch (Exception $e) {
            print json_encode(["status"=>'error', "message"=>"Erreur (" . $e->getLine() . ") : " . $e->getMessage()]);
        }
    }else{
        print json_encode(["status"=>'error', "message"=>"aucune donnée trouvée dans la requête"]);
    }

 ?>