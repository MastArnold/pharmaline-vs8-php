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

    if (isset($postdata) && !empty($postdata)) {
        $request = json_decode($postdata);
        $sql = $request->query;

        // Execute the multi-query
        if (mysqli_multi_query($conn, $sql)) {
            $myArray = array();

            // Process each result set
            do {
                if ($result = mysqli_store_result($conn)) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $myArray[] = array_map("utf8_encode", $row);
                    }
                    mysqli_free_result($result);
                }
            } while (mysqli_next_result($conn));

            if (!empty($myArray)) {
                echo json_encode($myArray);
            } else {
                echo json_encode(["response" => "0 result"]);
            }
        } else {
            echo json_encode(["response" => "Query execution failed"]);
        }
    }

// ...

?>