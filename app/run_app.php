<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: POST, GET");
    header('content-type: text/plain');  
    header("content-type: application/x-www-form-urlencoded");
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
    header("Access-Control-Max-Age: 172800");

    $postdata = file_get_contents("php://input");
    
    if(isset($postdata) && !empty($postdata)){
        //echo "Connected successfully";
        $request = json_decode($postdata);
        //$sql = $request->query;
        //
        $command = '"c:\Program Files (x86)\KLOG\KLOG.exe"'; // Remplacez le chemin et le nom du fichier par les vôtres

        // Utilisation de la fonction exec() pour exécuter la commande
        exec($command);

        $return_var = 0;
        // Vérification du code de retour pour savoir si l'exécution a réussi
        if ($return_var === 0) {
            print json_encode(['data'=>'Le logiciel a été exécuté avec succès.', 'status'=>'success']);
        } else {
            print json_encode(['data'=>"L'exécution du logiciel a échoué. Code de retour : $return_var", 'status'=>'error']);
        }

        // Affichage de la sortie (le cas échéant)
        /*if (!empty($output)) {
            echo "Sortie du programme :<br>";
            foreach ($output as $line) {
                echo $line . "<br>";
            }
        }*/
    }

    
?>
