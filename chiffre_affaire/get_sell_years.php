<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: POST");
    header('content-type: text/plain');  
    header("content-type: application/x-www-form-urlencoded");
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
    header("Access-Control-Max-Age: 172800");

    require_once "../connection_bd/conn_pdo.php";
    
    $sql = "SELECT 
                DATE_FORMAT(dateVente, '%Y') AS annee
            FROM `vente` 
            WHERE statutVente = 0
            GROUP BY DATE_FORMAT(dateVente, '%Y') 
            ORDER BY annee;";

    try{
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $resultats = $stmt->fetchAll();

        if ($resultats) {
            print json_encode(["data"=>$resultats, "status"=>"success"]);
        } else {
            print json_encode(["data"=>[], "status"=>"success"]);
        }
        
    } catch (Exception $e) {
        print json_encode(["status"=>'error', "message"=>$e->getMessage()]);
    }

 ?>