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
        $vente = Vente::fromJson($request->vente);
        $items = $request->items;
        $transactions = $request->transactions;
        $updateStock = $request->updateStock;

        try{
            $pdo->beginTransaction();

            $stmt_vente = $pdo->prepare($vente->get_insert_query_prepared());
            $stmt_vente->execute($vente->get_values_prepared());

            $idVente = $pdo->lastInsertId();

            foreach($transactions as $data_transaction){
                $transaction = TransactionVente::fromJson($data_transaction);
                $stmt_transaction = $pdo->prepare($transaction->get_insert_query_prepared());
                $stmt_transaction->execute($transaction->get_values_prepared());
            }

            foreach($items as $data_item){
                $item = VenteItem::fromJson($data_item);
                $item->set_idVente($idVente);
                $stmt_items = $pdo->prepare($item->get_insert_query_prepared());
                $stmt_items->execute($item->get_values_prepared());
                
                if($updateStock){
                    $stmt_stock = $pdo->prepare(Produit::get_update_minus_stock_query_prepared());
                    $stmt_stock->execute(Produit::get_update_operand_stock_values_prepared($item->idProduit, $item->quantite));
                }
            }
        
            $pdo->commit();            
            print json_encode(["status"=>'success', "message"=>"Vente enregistrée avec succès !"]);
        } catch (Exception $e) {
            $pdo->rollBack();
            print json_encode(["status"=>'error', "message"=>"Erreur (" . $e->getLine() . ") : " . $e->getMessage()]);
        }
    }else{
        print json_encode(["status"=>'error', "message"=>"aucune donnée trouvée dans la requête"]);
    }

 ?>