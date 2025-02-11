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

        // Spécifiez le chemin du répertoire que vous souhaitez explorer
        $repertoire = 'sauvegarde_file';

        // Utilisez la fonction scandir() pour obtenir la liste des fichiers
        $contenu_repertoire = scandir($repertoire);

        if($contenu_repertoire){
            // Parcourir la liste des fichiers et obtenir le nom et la taille
            foreach ($contenu_repertoire as $fichier) {
                // Exclure les entrées "." et ".." qui représentent le répertoire lui-même
                if ($fichier != "." && $fichier != ".." ) {
                    $chemin_fichier = $repertoire . '/' . $fichier;
                    $taille_octets = filesize($chemin_fichier);
                    $taille_mo = $taille_octets / 1048576;
                    $extension = pathinfo($fichier, PATHINFO_EXTENSION);
                    // Vérifiez si l'extension est ".sql"
                    if ($extension == "sql") {
                        $date_modification = filemtime($chemin_fichier);
                        $myArray[] = array_map(null, ["nom"=>"$fichier", "taille"=>"$taille_mo", "date"=>"$date_modification"]);
                    }
                }
            }
            print json_encode($myArray);
        }else{
            print json_encode(["response"=>"0 result"]);
        }
        
    }


 ?>