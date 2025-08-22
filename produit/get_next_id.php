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

    try{    
        $stmt = $pdo->prepare(Produit::get_select_counter_query_prepared());
        $stmt->execute([]);

        $suffix = '35OS';

        $results = $stmt->fetchAll();

        if(count($results) > 0){
            $produitId = '0';
            foreach($results as $row){
                $counter = $row['counter'] . '';
                //lenght of $counter
                $zeros_sum = strlen($suffix) - strlen($counter);
                $zeros = '';
                for($i = 0; $i < $zeros_sum; $i++){
                    $zeros .= '0';
                }
                $produitId = $suffix . $zeros . $counter;
            }
            print json_encode(["data"=>$produitId, "status"=>"success"]);
        }else{
            print json_encode([ "status"=>"error", "message"=>"aucune ligne trouvé dans le compteur d'identifiant produit !"]);
        }
    } catch (Exception $e) {
        print json_encode(["status"=>'error', "message"=>"Erreur (" . $e->getLine() . ") : " . $e->getMessage()]);
    }
 ?>