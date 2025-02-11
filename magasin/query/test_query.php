<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    require("../connection_bd/connection_bd.php");
    
    //echo "Connected successfully";
    $sql = "SELECT categorieProduit FROM produit GROUP BY categorieProduit;";
    $result = mysqli_query($conn,$sql); 
    //
    /*while ($row = mysqli_fetch_assoc($result)) {
        // Afficher les données
        foreach ($row as $value) {
            echo $value . " ";
        }
        echo "<br>";
    }*/
    //
    $myArray = array();
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $myArray[] = array_map(null, $row);
        }
        print json_encode($myArray);
    } 
    else 
    {
        echo "0 results";
    }
    
 ?>