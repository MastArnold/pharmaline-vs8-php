<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: POST");
    header('content-type: text/plain');  
    header("content-type: application/x-www-form-urlencoded");
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
    header("Access-Control-Max-Age: 172800");

    require_once "../connection_bd/conn_pdo.php";

    $postdata = file_get_contents("php://input");
    
    if(isset($postdata) && !empty($postdata)){
        //echo "Connected successfully";
        $request = json_decode($postdata);
        $date_debut = $request->date_debut;
        $date_fin = $request->date_fin;

        $sql = "SELECT 
                    DATE_FORMAT(dateVente, '%Y-%m') AS mois, 
                    SUM(totalVenteHT) AS total_ht, 
                    SUM(totalVenteTVA) AS total_tva, 
                    SUM(totalVente) AS total_ttc 
                FROM `vente` 
                WHERE dateVente BETWEEN :date_debut AND :date_fin 
                AND statutVente = 0
                GROUP BY DATE_FORMAT(dateVente, '%Y-%m') 
                ORDER BY mois;";

        try{
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['date_debut' => $date_debut, 'date_fin' => $date_fin]);
            $resultats = $stmt->fetchAll();

            if ($resultats) {
                print json_encode(["data"=>$resultats, "status"=>"success"]);
            } else {
                print json_encode(["data"=>[], "status"=>"success"]);
            }
            
        } catch (Exception $e) {
            print json_encode(["status"=>'error', "message"=>$e->getMessage()]);
        }
    }

 ?>