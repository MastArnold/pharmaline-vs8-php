<?php

class Vente{
    public int $id; // idVente
    public string $idVendeur;  // idUtilisateur
    public string $idOperateur;    // idOperateur
    public int $idClient;   // idClient
    public string $idOrdonnancier; // idOrdonnancier
    public int $total; // totalVente
    public int $totalHT;   // totalVenteHT
    public int $totalTVA;  // totalVenteTVA
    public string $modePaiement;  // modePaiementVente
    public string|null $codeOTP;    // codeOTP
    public int $montantPCE; // montantPCE
    public string $date;  // dateVente
    public string $heure; // heureVente
    public int $statut;    // statutVente

    public function __construct(int $id, string $vendeur, string $operateur, int $client, string $ordonnancier, int $total, int $totalHT, int $totalTVA, string $modePaiement, string|null $codeOTP, int $montantPCE, string $dateVente, string $heureVente, int $statut){
        $this->id = $id;
        $this->idVendeur = $vendeur;
        $this->idOperateur = $operateur;
        $this->idClient = $client;
        $this->idOrdonnancier = $ordonnancier;
        $this->total = $total;
        $this->totalHT = $totalHT;
        $this->totalTVA = $totalTVA;
        $this->modePaiement = $modePaiement;
        $this->codeOTP = $codeOTP;
        $this->montantPCE = $montantPCE;
        $this->date = $dateVente;
        $this->heure = $heureVente;
        $this->statut = $statut;
    }

    public static function fromJson(string $json): Vente {
        $data = json_decode($json, true);
        return new Vente(
            $data['id'],
            $data['idVendeur'],
            $data['idOperateur'],
            $data['idClient'],
            $data['idOrdonnancier'],
            $data['total'],
            $data['totalHT'],
            $data['totalTVA'],
            $data['modePaiement'],
            $data['codeOTP'] ? $data['codeOTP'] : null,
            $data['montantPCE'],
            $data['date'],
            $data['heure'],
            $data['statut']
        );
    }

    // INSERT

    public function get_insert_query(){
        return "INSERT INTO vente(
            idVente, 
            idUtilisateur, 
            idOperateur, 
            idClient, 
            idOrdonnancier, 
            totalVente, 
            totalVenteHT, 
            totalVenteTVA, 
            modePaiementVente, 
            codeOTP, 
            montantPCE, 
            dateVente, 
            heureVente, 
            statutVente
        ) VALUES (0, $this->idVendeur, $this->idOperateur, $this->idClient, $this->idOrdonnancier, $this->total, $this->totalHT, $this->totalTVA, '$this->modePaiement', $this->codeOTP, $this->montantPCE, '$this->date', '$this->heure', $this->statut);";
    }

    public function get_insert_query_prepared(){
        return "INSERT INTO vente(
            idVente, 
            idUtilisateur, 
            idOperateur, 
            idClient, 
            idOrdonnancier, 
            totalVente, 
            totalVenteHT, 
            totalVenteTVA, 
            modePaiementVente, 
            codeOTP, 
            montantPCE, 
            dateVente, 
            heureVente, 
            statutVente
        ) VALUES (:id, :idVendeur, :idOperateur, :idClient, :idOrdonnancier, :total, :totalHT, :totalTVA, :modePaiement, :codeOTP, :montantPCE, :datevente, :heure, :statut);";
    }

    public function get_values_prepared(){
        return [
            "id" => 0,
            "idVendeur" => $this->idVendeur,
            "idOperateur" => $this->idOperateur,
            "idClient" => $this->idClient,
            "idOrdonnancier" => $this->idOrdonnancier,
            "total" => $this->total,
            "totalHT" => $this->totalHT,
            "totalTVA" => $this->totalTVA,
            "modePaiement" => $this->modePaiement,
            "codeOTP" => $this->codeOTP,
            "montantPCE" => $this->montantPCE,
            "datevente" => $this->date,
            "heure" => $this->heure,
            "statut" => $this->statut
        ];
    }

    // UPDATE

    public function get_update_query_prepared(){
        return "UPDATE vente SET 
            idUtilisateur = :idVendeur, 
            idOperateur = :idOperateur, 
            idClient = :idClient, 
            idOrdonnancier = :idOrdonnancier, 
            totalVente = :total, 
            totalVenteHT = :totalHT, 
            totalVenteTVA = :totalTVA, 
            modePaiementVente = :modePaiement, 
            codeOTP = :codeOTP, 
            montantPCE = :montantPCE, 
            dateVente = :datevente, 
            heureVente = :heure, 
            statutVente = :statut
        WHERE idVente = :id;";
    }

    public function get_update_values_prepared(){
        return [
            "idVendeur" => $this->idVendeur,
            "idOperateur" => $this->idOperateur,
            "idClient" => $this->idClient,
            "idOrdonnancier" => $this->idOrdonnancier,
            "total" => $this->total,
            "totalHT" => $this->totalHT,
            "totalTVA" => $this->totalTVA,
            "modePaiement" => $this->modePaiement,
            "codeOTP" => $this->codeOTP,
            "montantPCE" => $this->montantPCE,
            "datevente" => $this->date,
            "heure" => $this->heure,
            "statut" => $this->statut,
            "id" => $this->id
        ];
    }

    public static function get_update_codeOTP_query_prepared(){
        return "UPDATE vente SET codeOTP = :code WHERE codeOTP = :oldCode;";
    }

    public static function get_update_codeOTP_values_prepared($old_code, $code){
        return [
            "code" => $code,
            "oldCode" => $old_code
        ];
    }

    public static function get_delete_query_prepared(){
        return "DELETE FROM vente WHERE idVente = :id;";
    }

    public static function get_delete_values_prepared($id){
        return [
            "id" => $id
        ];
    }

}

class VenteItem{
    public $id; // idVenteDetail
    public $idVente; // idVente
    public $idProduit; // idProduit
    public $quantite; // quantiteVenteDetail
    public $prix; // prixVenteDetail
    public $remise; // remiseVenteDetail
    public $statut; // statutVenteDetail

    public function __construct($id, $idVente, $idProduit, $quantite, $prix, $remise, $statut){
        $this->id = $id;
        $this->idVente = $idVente;
        $this->idProduit = $idProduit;
        $this->quantite = $quantite;
        $this->prix = $prix;
        $this->remise = $remise;
        $this->statut = $statut;
    }

    public function set_idVente($idVente){
        $this->idVente = $idVente;
    }

    public static function fromJson(string $json): VenteItem{
        $data = json_decode($json, true);
        return new VenteItem(
            $data['id'], 
            $data['idVente'], 
            $data['idProduit'], 
            $data['quantite'], 
            $data['prix'], 
            $data['remise'], 
            $data['statut']
        );
    }

    /**
     * requete sql pour récupérer tous les items d'une vente
     */
    public static function get_select_by_idVente_query_prepared(){
        return "SELECT * FROM venteDetail WHERE idVente = :idVente";
    }
    public static function get_select_by_idVente_values_prepared(int $idVente){
        return [
            "idVente" => $idVente
        ];
    }

    function get_insert_query(){
        return "INSERT INTO venteDetail(
            idVenteDetail, 
            idVente, 
            idProduit, 
            quantiteVenteDetail, 
            prixVenteDetail, 
            remiseVenteDetail, 
            statutVenteDetail
        ) VALUES (0, $this->idVente, $this->idProduit, $this->quantite, $this->prix, $this->remise, $this->statut);";
    }

    function get_insert_query_prepared(){
        return "INSERT INTO venteDetail(
            idVenteDetail, 
            idVente, 
            idProduit, 
            quantiteVenteDetail, 
            prixVenteDetail, 
            remiseVenteDetail, 
            statutVenteDetail
        ) VALUES (:id, :idVente, :idProduit, :quantite, :prix, :remise, :statut);";
    }

    function get_values_prepared(){
        return [
            "id" => 0,
            "idVente" => $this->idVente,
            "idProduit" => $this->idProduit,
            "quantite" => $this->quantite,
            "prix" => $this->prix,
            "remise" => $this->remise,
            "statut" => $this->statut
        ];
    }

    public static function get_delete_by_idVente_query_prepared(){
        return "DELETE FROM venteDetail WHERE idVente = :idVente;";
    }

    public static function get_delete_by_idVente_values_prepared(int $idVente){
        return [
            "idVente" => $idVente
        ];
    }

    public static function get_delete_query_prepared(){
        return "DELETE FROM venteDetail WHERE idVenteDetail = :id;";
    }

    public static function get_delete_values_prepared(int $id){
        return [
            "id" => $id
        ];
    }

}

class TransactionVente{
    public $id;
    public $idVente;
    public $montant;
    public $modePaiement;
    public $reference;

    public function __construct($id, $idVente, $modePaiement, $montant, $reference){
        $this->id = $id;
        $this->idVente = $idVente;
        $this->modePaiement = $modePaiement;
        $this->montant = $montant;
        $this->reference = $reference;
    }

    public static function fromJson(string $json): TransactionVente{
        $data = json_decode($json, true);
        return new TransactionVente(
            $data['id'], 
            $data['idVente'], 
            $data['modePaiement'], 
            $data['montant'], 
            $data['reference']
        );
    }

    function get_insert_query(){
        return "INSERT INTO transactionVente(
            idTransaction, 
            idVente, 
            codeMode, 
            montant, 
            reference
        ) VALUES (0, $this->idVente, $this->modePaiement, $this->montant, $this->reference);";
    }

    function get_insert_query_prepared(){
        return "INSERT INTO transactionVente(
            idTransaction, 
            idVente, 
            codeMode, 
            montant, 
            reference
        ) VALUES (:id, :idVente, :modePaiement, :montant, :reference);";
    }

    function get_values_prepared(){
        return [
            "id" => 0,
            "idVente" => $this->idVente,
            "modePaiement" => $this->modePaiement,
            "montant" => $this->montant,
            "reference" => $this->reference
        ];
    }

    public static function get_delete_by_idVente_query_prepared(){
        return "DELETE FROM transactionVente WHERE idVente = :idVente;";
    }

    public static function get_delete_by_idVente_values_prepared($idVente){
        return [
            "idVente" => $idVente
        ];
    }

}

?>