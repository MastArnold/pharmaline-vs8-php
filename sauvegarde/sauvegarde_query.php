<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: POST, GET");
    header('content-type: text/plain');  
    header("content-type: application/x-www-form-urlencoded");
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
    header("Access-Control-Max-Age: 172800");

    require("../connection_bd/connection_bd.php");

    $postdata = file_get_contents("php://input");
    
    if(isset($postdata) && !empty($postdata)){
        //echo "Connected successfully";
        $request = json_decode($postdata);
        $sql = $request->query;
        //
        
        $chemin_fichier = 'sauvegarde_file/bd_'.date('d-m-Y_H-i').'.sql';
        if (file_put_contents($chemin_fichier, $sql) !== false) {
            print json_encode(["status"=>"success", "response"=>"Contenu écrit avec succès."]);
        } else {
            print json_encode(["status"=>"error", "response"=>"Impossible d'écrire dans le fichier."]);
        }
    }

 ?>