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
        $backup = $request->backup;
        $DB = $request->database;

        $backup_path = "../sauvegarde/sauvegarde_file/$backup"; // Remplacez par le chemin de votre fichier
        $db_structure_path = "../sauvegarde/database_structure/data.sql";
        $db_auto_increment_path = "../sauvegarde/database_structure/AUTO_INCREMENT.sql";

        // Vérifiez si le fichier de sauvegarde existe
        if (file_exists($backup_path) && file_exists($db_structure_path) && file_exists($db_auto_increment_path)) {
            $sql = file_get_contents($backup_path);
            $db_auto_increment = file_get_contents($db_auto_increment_path);
            $db_structure = file_get_contents($db_structure_path);

            $db_structure .= $db_auto_increment;
            
            //suppression de la base de données
            if($conn->query("DROP DATABASE $DB;")){
                if($conn->query("CREATE DATABASE $DB CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;")){
                    $conn->close();

                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    
                    // Check connection
                    if ($conn->connect_error) {
                        print json_encode(['data'=>'Connexion à la base de donnée échoué !', 'status'=>'error', 'precision'=>'BD']);
                    }else{
                        if($conn->multi_query($db_structure)){
                            while ($conn->next_result()) {;}
                            if($conn->multi_query($sql)){
                                while ($conn->next_result()) {;}
                                print json_encode(['data'=>'restauration réussie', 'status'=>'success']);
                            }else{
                                print json_encode(['data'=>'restauration de la BD échouée !', 'status'=>'error', 'precision'=>'restore']);
                            }
                        }else{
                            print json_encode(['data'=>'définission de la structure de la BD échouée !', 'status'=>'error', 'precision'=>'restore']);
                        }
                       
                    }
                }else{
                    print json_encode(['data'=>'création de la BD échouée !', 'status'=>'error', 'precision'=>'create']);
                }
            }else{
                print json_encode(['data'=>'suppression de la BD échouée !', 'status'=>'error', 'precision'=>'delete']);
            }
        } else {
            print json_encode(['data'=>'Le fichier de sauvagarde est introuvable !', 'status'=>'error', 'precision'=>'file']);
        }
    }


 ?>