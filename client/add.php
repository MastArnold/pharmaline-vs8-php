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

    $postdata = file_get_contents("php://input");
    
    if(isset($postdata) && !empty($postdata)){
        //echo "Connected successfully";
        $request = json_decode($postdata);
        $client = Client::fromJson($request->client);

        try{
            $pdo->beginTransaction();

            $stmt = $pdo->prepare(Client::get_insert_query_prepared());
            $stmt->execute($client->get_insert_values_prepared());

            $stmt_last_insert = $pdo->prepare(Client::lastInsertIdQuery());
            $stmt_last_insert->execute([]);
            $result = $stmt_last_insert->fetch();

            $pdo->commit();            
            print json_encode(["status"=>"success", "message"=>"Client enregistrée avec succès !", "id"=>$result["idClient"]]);
        } catch (Exception $e) {
            $pdo->rollBack();
            print json_encode(["status"=>"error", "message"=>"Erreur (" . $e->getLine() . ") : " . $e->getMessage()]);
        }
    }else{
        print json_encode(["status"=>'error', "message"=>"aucune donnée trouvée dans la requête"]);
    }

 ?>