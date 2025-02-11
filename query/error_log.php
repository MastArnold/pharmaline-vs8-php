<?php
    function print_log($log){
        $chemin_fichier = 'log/'.date('d-m-Y_H-i-s').'.txt';
        if (file_put_contents($chemin_fichier, $log) !== true) {
            //print json_encode(["status"=>"error", "response"=>"Impossible d'écrire dans le fichier."]);
        } 
    }
?>