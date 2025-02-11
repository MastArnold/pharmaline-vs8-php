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
        $data = json_decode($postdata);
        $id = $data->id;

        $sql = "SELECT * FROM vente ";
            if($data->pending == true){
                $sql .= "INNER JOIN utilisateur ON vente.idOperateur = utilisateur.idUtilisateur ";
            } else {
                $sql .= "INNER JOIN utilisateur ON vente.idUtilisateur = utilisateur.idUtilisateur ";
            }
            $sql .= "INNER JOIN client ON vente.idClient = client.idClient 
                     WHERE idVente = :idVente;";
        try{
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['idVente' => $id]);

            $resultats = $stmt->fetchAll();
            if ($resultats) {
                foreach ($resultats as &$row) {
                    $sql_transaction = "SELECT * FROM transactionvente WHERE idVente = :idVente";
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
        print json_encode(["status"=>'error', "message"=>"aucune donnée trouvée dans la requête"]);
    }

 ?>