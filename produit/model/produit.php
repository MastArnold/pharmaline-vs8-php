<?php
class Produit{
    public string $id; // idProduit
    public string $nomNc;   //  nomNcProduit
    public string $nomDci;  //  nomDciProduit
    public string $categorie;   //  categorieProduit
    public string $rayon;   //  rayonProduit
    public int $prixVente;   //  prixVenteProduit
    public int $prixAchat;   //  prixAchatProduit
    public int $stock;   //  stockProduit
    public int $limiteStock; //  limiteStockProduit
    public int $uniteParBoite;  //  uniteParBoite
    public bool $venteEnDetail;  //  venteEnDetail
    public int $tva; //  tvaProduit
    public string $datePeremption;  //  datePeremptionProduit
    public bool $sousOrdonnance; //  sousOrdonnance
    public int $statut;  //  statutProduit

    public function __construct(string $id, string $nomNc, string $nomDci, string $categorie, string $rayon, int $prixVente, int $prixAchat, int $stock, int $limiteStock, int $uniteParBoite, bool $venteEnDetail, int $tva, string $datePeremption, bool $sousOrdonnance, int $statut){
        $this->id = $id;
        $this->nomNc = $nomNc;
        $this->nomDci = $nomDci;
        $this->categorie = $categorie;
        $this->rayon = $rayon;
        $this->prixVente = $prixVente;
        $this->prixAchat = $prixAchat;
        $this->stock = $stock;
        $this->limiteStock = $limiteStock;
        $this->uniteParBoite = $uniteParBoite;
        $this->venteEnDetail = $venteEnDetail;
        $this->tva = $tva;
        $this->datePeremption = $datePeremption;
        $this->sousOrdonnance = $sousOrdonnance;
        $this->statut = $statut;
    }

    public static function fromJson(string $json): Produit{
        $data = json_decode($json, true);
        return new Produit(
            $data['idProduit'],
            $data['nomNcProduit'],
            $data['nomDciProduit'],
            $data['categorieProduit'],
            $data['rayonProduit'],
            $data['prixVenteProduit'],
            $data['prixAchatProduit'],
            $data['stockProduit'],
            $data['limiteStockProduit'],
            $data['uniteParBoite'],
            $data['venteEnDetail'],
            $data['tvaProduit'],
            $data['datePeremptionProduit'],
            $data['sousOrdonnance'],
            $data['statutProduit']
        );
    }

    public function get_insert_query(){
        return "INSERT INTO produit(
            idProduit, 
            nomNcProduit, 
            nomDciProduit, 
            categorieProduit, 
            rayonProduit, 
            prixVenteProduit, 
            prixAchatProduit, 
            stockProduit, 
            limiteStockProduit, 
            uniteParBoite, 
            venteEnDetail, 
            tvaProduit, 
            datePeremptionProduit, 
            sousOrdonnance, 
            statutProduit
        ) VALUES (
            $this->id, 
            '$this->nomNc', 
            '$this->nomDci', 
            '$this->categorie', 
            '$this->rayon', 
            $this->prixVente, 
            $this->prixAchat, 
            $this->stock, 
            $this->limiteStock, 
            $this->uniteParBoite, 
            $this->venteEnDetail, 
            $this->tva, 
            '$this->datePeremption', 
            $this->sousOrdonnance, 
            $this->statut
        )";
    }

    public static function get_insert_query_prepared(){
        return "INSERT INTO produit(
            idProduit, 
            nomNcProduit, 
            nomDciProduit, 
            categorieProduit, 
            rayonProduit, 
            prixVenteProduit, 
            prixAchatProduit, 
            stockProduit, 
            limiteStockProduit, 
            uniteParBoite, 
            venteEnDetail, 
            tvaProduit, 
            datePeremptionProduit, 
            sousOrdonnance, 
            statutProduit
        ) VALUES (
            :id, 
            :nomNc, 
            :nomDci,    
            :categorie, 
            :rayon, 
            :prixVente, 
            :prixAchat, 
            :stock, 
            :limiteStock, 
            :uniteParBoite, 
            :venteEnDetail, 
            :tva, 
            :datePeremption, 
            :sousOrdonnance, 
            :statut
        )";
    }

    public function get_insert_values_prepared(){
        return [
            "id" => $this->id,
            "nomNc" => $this->nomNc,
            "nomDci" => $this->nomDci,
            "categorie" => $this->categorie,
            "rayon" => $this->rayon,
            "prixVente" => $this->prixVente,
            "prixAchat" => $this->prixAchat,
            "stock" => $this->stock,
            "limiteStock" => $this->limiteStock,
            "uniteParBoite" => $this->uniteParBoite,
            "venteEnDetail" => $this->venteEnDetail,
            "tva" => $this->tva,
            "datePeremption" => $this->datePeremption,
            "sousOrdonnance" => $this->sousOrdonnance,
            "statut" => $this->statut
        ];
    }

    public static function get_update_query_prepared(){
        return "UPDATE produit SET 
                nomNcProduit = :nomNc, 
                nomDciProduit = :nomDci, 
                categorieProduit = :categorie, 
                rayonProduit = :rayon, 
                prixVenteProduit = :prixVente, 
                prixAchatProduit = :prixAchat, 
                stockProduit = :stock, 
                limiteStockProduit = :limiteStock, 
                uniteParBoite = :uniteParBoite, 
                venteEnDetail = :venteEnDetail, 
                tvaProduit = :tva, 
                datePeremptionProduit = :datePeremption, 
                sousOrdonnance = :sousOrdonnance, 
                statutProduit = :statut WHERE idProduit = :idProduit";
    }

    public function get_update_values_prepared(){
        return [
            "nomNc" => $this->nomNc,
            "nomDci" => $this->nomDci,
            "categorie" => $this->categorie,
            "rayon" => $this->rayon,
            "prixVente" => $this->prixVente,
            "prixAchat" => $this->prixAchat,
            "stock" => $this->stock,
            "limiteStock" => $this->limiteStock,
            "uniteParBoite" => $this->uniteParBoite,
            "venteEnDetail" => $this->venteEnDetail,
            "tva" => $this->tva,
            "datePeremption" => $this->datePeremption,
            "sousOrdonnance" => $this->sousOrdonnance,
            "statut" => $this->statut,
            "idProduit" => $this->id
        ];
    }

    public static function get_update_add_stock_query_prepared(){
        return "UPDATE produit SET stockProduit = stockProduit + :quantite WHERE idProduit = :idProduit";
    }

    public static function get_update_minus_stock_query_prepared(){
        return "UPDATE produit SET stockProduit = stockProduit - :quantite WHERE idProduit = :idProduit";
    }

    public static function get_update_operand_stock_values_prepared(string $idProduit, int $quantite){
        return [
            "quantite" => $quantite,
            "idProduit" => $idProduit
        ];
    }

}


?>