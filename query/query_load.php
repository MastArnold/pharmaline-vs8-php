<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: POST, GET");
    header('content-type: text/plain');  
    header("content-type: application/x-www-form-urlencoded");
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
    header("Access-Control-Max-Age: 172800");

    require("../connection_bd/connection_bd.php");
    require("../query/error_log.php");

    $postdata = file_get_contents("php://input");
    
    if(isset($postdata) && !empty($postdata)){
        //echo "Connected successfully";
        $request = json_decode($postdata);
        $sql = $request->query;
        //
        try{
            $result = mysqli_query($conn,$sql); 
            if($result){
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
                    print json_encode(["response"=>"0 result", "status"=>"empty"]);
                }
            }else{
                $error_message = mysqli_error($conn);
                print json_encode(["response"=>"$error_message", "status"=>"error"]);
            }
        } catch (Exception $e) {
            $log = "sql : $sql \nerror : ".$e->getMessage();
            print_log($log);
            // Gérer toute exception générée lors de l'exécution de la requête
            throw new Error($e->getMessage());
        }
    }


 ?>