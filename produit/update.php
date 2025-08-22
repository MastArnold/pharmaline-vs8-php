<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: POST, GET");
    header('content-type: text/plain');  
    header("content-type: application/x-www-form-urlencoded");
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
    header("Access-Control-Max-Age: 172800");

    require_once "../connection_bd/conn_pdo.php";
    require "model/produit.php";

    $postdata = file_get_contents("php://input");
    
    if(isset($postdata) && !empty($postdata)){
        //echo "Connected successfully";
        $request = json_decode($postdata);
        $produit = Produit::fromJson($request->produit);

        try{
            $pdo->beginTransaction();

            $stmt = $pdo->prepare(Produit::get_update_query_prepared());
            $stmt->execute($produit->get_values_prepared());

            $pdo->commit();
            print json_encode(["status"=>"success", "message"=>"Produit modifié avec succès !"]);
        } catch (Exception $e) {
            $pdo->rollBack();
            print json_encode(["status"=>"error", "message"=>"Erreur (" . $e->getLine() . ") : " . $e->getMessage()]);
        }
    }else{
        print json_encode(["status"=>'error', "message"=>"aucune donnée trouvée dans la requête"]);
    }

 ?>