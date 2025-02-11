<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: POST, GET");
    header('content-type: text/plain');  
    header("content-type: application/x-www-form-urlencoded");
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
    header("Access-Control-Max-Age: 172800");

    require_once "../connection_bd/conn_pdo.php";
    require "model/vente.php";
    require "../produit/model/produit.php";

    $postdata = file_get_contents("php://input");
    
    if(isset($postdata) && !empty($postdata)){
        //echo "Connected successfully";
        $request = json_decode($postdata);
        $idVente = $request->idVente;
        $updateStock = $request->updateStock;

        try{
            $pdo->beginTransaction();

            $stmt_vente = $pdo->prepare(Vente::get_delete_query_prepared());
            $stmt_vente->execute(Vente::get_delete_values_prepared($idVente));

            if($updateStock){
                $stmt_item = $pdo->prepare(VenteItem::get_select_by_idVente_query_prepared());
                $stmt_item->execute(VenteItem::get_select_by_idVente_values_prepared($idVente));
                $items = $stmt_item->fetchAll();

                foreach($items as $item){
                    $stmt_stock = $pdo->prepare(Produit::get_update_add_stock_query_prepared());
                    $stmt_stock->execute(Produit::get_update_operand_stock_values_prepared($item['idProduit'], $item['quantiteVenteDetail']));
                }
            }
            
            $stmt_delete_vente_item = $pdo->prepare(VenteItem::get_delete_by_idVente_query_prepared());
            $stmt_delete_vente_item->execute(VenteItem::get_delete_by_idVente_values_prepared($idVente));
        
            $pdo->commit();            
            print json_encode(["status"=>"success", "message"=>"Vente supprimé avec succès !"]);
        } catch (Exception $e) {
            $pdo->rollBack();
            print json_encode(["status"=>"error", "message"=>"Erreur (" . $e->getLine() . ") : " . $e->getMessage()]);
        }
    }else{
        print json_encode(["status"=>'error', "message"=>"aucune donnée trouvée dans la requête"]);
    }

 ?>