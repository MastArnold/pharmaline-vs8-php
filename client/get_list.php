<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: POST, GET");
    header('content-type: text/plain');  
    header("content-type: application/x-www-form-urlencoded");
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
    header("Access-Control-Max-Age: 172800");

    require_once "../connection_bd/conn_pdo.php";
    require "model/client.php";

    try{    
        $stmt = $pdo->prepare(Client::get_select_all_query());
        $stmt->execute([]);

        $results = $stmt->fetchAll();

        if(count($results) > 0){
            print json_encode(["results"=>$results, "status"=>"success"]);
        }else{
            print json_encode(["results"=>[], "status"=>"success"]);
        }
    } catch (Exception $e) {
        print json_encode(["status"=>'error', "message"=>"Erreur (" . $e->getLine() . ") : " . $e->getMessage()]);
    }
 ?>