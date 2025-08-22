<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: POST");
    header('content-type: text/plain');  
    header("content-type: application/x-www-form-urlencoded");
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
    header("Access-Control-Max-Age: 172800");

    require_once "../connection_bd/conn_pdo.php";

    $name = $dbname;
    $outputFile = "bd_backup/" . date('d_m_Y_H_i_s') . ".sql";

    try{
        $handle = fopen($outputFile, 'w');
        if (!$handle) {
            throw new Exception("Impossible d'ouvrir le fichier de sortie: $outputFile");
        }

        fwrite($handle, "-- Dump complet de la base de données '$name'\n");
        fwrite($handle, "-- Généré le " . date('Y-m-d H:i:s') . "\n\n");
        fwrite($handle, "SET NAMES utf8;\n");
        fwrite($handle, "SET GLOBAL max_allowed_packet = 1073741824;\n\n"); // Augmente max_allowed_packet si nécessaire

        // Récupérer toutes les tables de la base de données
        $stmtTables = $pdo->query("SHOW TABLES");
        $tables = $stmtTables->fetchAll(PDO::FETCH_COLUMN);

        foreach ($tables as $table) {
            fwrite($handle, "--\n");
            fwrite($handle, "-- Structure de la table `$table`\n");
            fwrite($handle, "--\n\n");

            // Obtenir la requête CREATE TABLE
            $stmtCreateTable = $pdo->query("SHOW CREATE TABLE `$table`");
            $rowCreateTable = $stmtCreateTable->fetch(PDO::FETCH_NUM);
            fwrite($handle, $rowCreateTable[1] . ";\n\n"); // $rowCreateTable[1] contient la requête CREATE TABLE

            fwrite($handle, "--\n");
            fwrite($handle, "-- Données pour la table `$table`\n");
            fwrite($handle, "--\n\n");

            // Récupérer les données de chaque table
            $stmtData = $pdo->query("SELECT * FROM `$table`");
            $columns = [];
            for ($i = 0; $i < $stmtData->columnCount(); $i++) {
                $colMeta = $stmtData->getColumnMeta($i);
                $columns[] = "`{$colMeta['name']}`";
            }
            $columnList = implode(', ', $columns);

            while ($row = $stmtData->fetch(PDO::FETCH_ASSOC)) {
                $values = [];
                foreach ($row as $value) {
                    if (is_null($value)) {
                        $values[] = 'NULL';
                    } else {
                        $values[] = $pdo->quote($value);
                    }
                }
                $valueList = implode(', ', $values);
                fwrite($handle, "INSERT INTO `$table` ($columnList) VALUES ($valueList);\n");
            }
            fwrite($handle, "\n");
        }

        fclose($handle);
        $tables_str = implode(",", $tables);
        print json_encode(
            [
                "status"=>'success', 
                "message"=>"Les données de la base de données ont été exportées avec succès dans '$outputFile'.\n",
                "data"=>$tables_str
            ]
        );
    }catch(Exception $e){
        print json_encode(["status"=>'success', "message"=>"Une erreur s'est produite : " . $e->getMessage()]);
    }