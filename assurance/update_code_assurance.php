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
    require "../vente/model/vente.php";

    $postdata = file_get_contents("php://input");
    
    if(isset($postdata) && !empty($postdata)){
        //echo "Connected successfully";
        $request = json_decode($postdata);
        $old_code = $request->old_code;
        $nw_code = $request->nw_code;

        try{
            $pdo->beginTransaction();

            $stmt = $pdo->prepare(Assurance::get_update_code_query_prepared());
            $stmt->execute(Assurance::get_update_code_values_prepared($old_code, $nw_code));

            $stmt_vente = $pdo->prepare(Vente::get_update_codeOTP_query_prepared());
            $stmt_vente->execute(Vente::get_update_codeOTP_values_prepared($old_code, $nw_code));
        
            $pdo->commit();            
            print json_encode(["status"=>'success', "message"=>"Code de l'OTP mise à jour avec succès !"]);
        } catch (Exception $e) {
            $pdo->rollBack();
            print json_encode(["status"=>'error', "message"=>"Erreur (" . $e->getLine() . ") : " . $e->getMessage()]);
        }
    }else{
        print json_encode(["status"=>'error', "message"=>"aucune donnée trouvée dans la requête"]);
    }

 ?>