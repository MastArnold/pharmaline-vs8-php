<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    require("../connection_bd/connection_bd.php");

    if(isset($_GET["load"])){
        //echo "Connected successfully";
        $sql = "SELECT * FROM ajustementstockitem 
                INNER JOIN ajustementstock ON ajustementstockitem.designationAjustementStock = ajustementstock.designationAjustementStock
                INNER JOIN utilisateur ON utilisateur.idUtilisateur = ajustementstock.idUtilisateur
                INNER JOIN produit ON ajustementstockitem.idProduit = produit.idProduit;";
        $result = mysqli_query($conn,$sql); 
        $myArray = array();
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $myArray[] = array_map("utf8_encode", $row);
            }
            print json_encode($myArray);
        } 
        else 
        {
            print json_encode("0 results");
        }
    }


 ?>