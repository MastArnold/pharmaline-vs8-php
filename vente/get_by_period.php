<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: POST, GET");
    header('content-type: text/plain');  
    header("content-type: application/x-www-form-urlencoded");
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
    header("Access-Control-Max-Age: 172800");

    require_once "../connection_bd/conn_pdo.php";

    $postdata = file_get_contents("php://input");
    
    if(isset($postdata) && !empty($postdata)){
        //echo "Connected successfully";
        $data = json_decode($postdata);
        $period = isset($data->period) ? json_decode($data->period) : null;
        if($period != null){
            $date1 = $period->date1;
            $date2 = $period->date2;

            $sql = "SELECT * FROM vente 
                    INNER JOIN utilisateur ON vente.idUtilisateur = utilisateur.idUtilisateur 
                    INNER JOIN client ON vente.idClient = client.idClient 
                    WHERE dateVente BETWEEN :date1 AND :date2 AND statutVente = 0 
                    ORDER BY idVente DESC";
            
            try{
                $stmt = $pdo->prepare($sql);
                $stmt->execute(['date1' => $date1, 'date2' => $date2]);

                $resultats = $stmt->fetchAll();

                if ($resultats) {
                    foreach ($resultats as &$row) {
                        $sql_transaction = "SELECT * FROM transactionvente WHERE idVente = :idVente;";
                        $stmt_transaction = $pdo->prepare($sql_transaction);
                        $stmt_transaction->execute(['idVente' => $row['idVente']]);
                        $transactions = $stmt_transaction->fetchAll();
                        $row['transactions'] = $transactions ? $transactions : [];
                    }
                    print json_encode(["results"=>$resultats, "status"=>"success"]);
                } else {
                    print json_encode(["results"=>[], "status"=>"success"]);
                }
                
            } catch (Exception $e) {
                print json_encode(["status"=>'error', "message"=>$e->getMessage()]);
            }
        }else{
            print json_encode(["status"=>'error', "message"=>"Période introuvable dans la requête"]);
        }
    }else{
        print json_encode(["status"=>'error', "message"=>"aucune donnée trouvée dans la requête"]);
    }

 ?>