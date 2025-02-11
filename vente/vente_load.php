<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: POST, GET");
    header('content-type: text/plain');  
    header("content-type: application/x-www-form-urlencoded");
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
    header("Access-Control-Max-Age: 172800");

    require("../connection_bd/connection_bd.php");

    // Get the posted data.
    $postdata = file_get_contents("php://input");
    
    if(isset($postdata) && !empty($postdata))
    {
        // Extract the data.
        $request = json_decode($postdata);
      
        $sql = "SELECT * FROM vente ORDER BY idVente DESC";
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
          print json_encode(['data'=>'', 'status'=>'empty']);
        }
      
    }else{
      print json_encode(['data'=>'Erreur : Aucune donnée presente !', 'status'=>'error']);
    }

 ?>