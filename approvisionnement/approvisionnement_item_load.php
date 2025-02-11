<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    
    require("../connection_bd/connection_bd.php");

    if(isset($_GET["load"])){
        //echo "Connected successfully";
        $sql = "SELECT * FROM approvisionnementitem 
                INNER JOIN approvisionnement ON approvisionnementitem.idApprovisionnement = approvisionnement.idApprovisionnement
                INNER JOIN fournisseur ON fournisseur.idFournisseur = approvisionnement.idFournisseur
                INNER JOIN produit ON approvisionnementitem.idProduit = produit.idProduit 
                ORDER BY approvisionnementitem.idApprovisionnement";
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