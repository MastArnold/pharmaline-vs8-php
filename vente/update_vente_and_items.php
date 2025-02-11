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
        $data = json_decode($postdata);
        $vente = Vente::fromJson($data->vente);
        $items = $data->items;
        $transactions = $data->transactions;
        $updateStock = $data->updateStock;

        try{
            $pdo->beginTransaction();

            //mettre à jour la vente
            $stmt_vente = $pdo->prepare($vente->get_update_query_prepared());
            $stmt_vente->execute($vente->get_update_values_prepared());

            //supprimer les anciennes transactions
            $stmt_transaction_delete = $pdo->prepare(TransactionVente::get_delete_by_idVente_query_prepared());
            $stmt_transaction_delete->execute(TransactionVente::get_delete_by_idVente_values_prepared($vente->id));

            //inserer les nouvelles transactions
            foreach($transactions as $data_transaction){
                $transaction = TransactionVente::fromJson($data_transaction);
                $stmt_transaction = $pdo->prepare($transaction->get_insert_query_prepared());
                $stmt_transaction->execute($transaction->get_values_prepared());
            }
            
            //supprimer les anciens items et mettre à jour le stock
            $stmt_old_items = $pdo->prepare(VenteItem::get_select_by_idVente_query_prepared());
            $stmt_old_items->execute(VenteItem::get_select_by_idVente_values_prepared($vente->id));
            $old_items = $stmt_old_items->fetchAll();
            foreach($old_items as $item){
                $stmt_item = $pdo->prepare(VenteItem::get_delete_query_prepared());
                $stmt_item->execute(VenteItem::get_delete_values_prepared($item['idVenteDetail']));

                if($updateStock){
                    $stmt_stock = $pdo->prepare(Produit::get_update_add_stock_query_prepared());
                    $stmt_stock->execute(Produit::get_update_operand_stock_values_prepared($item['idProduit'], $item['quantiteVenteDetail']));
                }
            }

            // ajouter les nouveaux items
            foreach($items as $data_item){
                $item = VenteItem::fromJson($data_item);
                $stmt_items = $pdo->prepare($item->get_insert_query_prepared());
                $stmt_items->execute($item->get_values_prepared());
                
                if($updateStock){
                    $stmt_stock = $pdo->prepare(Produit::get_update_minus_stock_query_prepared());
                    $stmt_stock->execute(Produit::get_update_operand_stock_values_prepared($item->idProduit, $item->quantite));
                }
            }
        
            $pdo->commit();            
            print json_encode(["status"=>"success", "message"=>"Vente modifiée avec succès !"]);
        } catch (Exception $e) {
            $pdo->rollBack();
            print json_encode(["status"=>'error', "message"=>"Erreur (" . $e->getLine() . ") : " . $e->getMessage()]);
        }
    }else{
        print json_encode(["status"=>'error', "message"=>"aucune donnée trouvée dans la requête"]);
    }

 ?>