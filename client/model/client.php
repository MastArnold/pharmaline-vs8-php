<?php

class Client{
    public int $id; // idClient
    public string $nom; // nomClient
    public string $telephone; // telephoneClient
    public int $statut; // statutClient

    public function __construct(int $id , string $nom, string $telephone, int $statut){
        $this->id = $id;
        $this->nom = $nom;
        $this->telephone = $telephone;
        $this->statut = $statut;
    }

    public static function fromJson(string $json){
        $data = json_decode($json, true);
        return new Client($data['id'], $data['nom'], $data['telephone'], $data['statut']);
    }

    public static function get_select_all_query(){
        return "SELECT * FROM client ORDER BY idClient";
    }

    public static function get_select_byId_query_prepared(){
        return "SELECT * FROM client WHERE idClient = :id";
    }   

    public static function get_select_byId_values_prepared($id){
        return [
            'id' => $id
        ];
    }

    public static function get_select_byName_query_prepared(){
        return "SELECT * FROM client WHERE nomClient LIKE :nom";
    }

    public static function get_select_byName_values_prepared($nom){
        return [
            'nom' => '%'.$nom.'%'
        ];
    }

    public static function get_select_byPhone_query_prepared(){
        return "SELECT * FROM client WHERE telephoneClient = :phone";
    }

    public static function get_select_byPhone_values_prepared($phone){
        return [
            'phone' => $phone
        ];
    }

    public static function get_insert_query_prepared(){
        return "INSERT INTO client(nomClient, telephoneClient, statutClient) VALUES (:nom, :phone, :statut)";
    }

    public function get_insert_values_prepared(){
        return [
            'nom' => $this->nom,
            'phone' => $this->telephone,
            'statut' => $this->statut
        ];
    }

    public static function lastInsertIdQuery(){
        return "SELECT idClient FROM client ORDER BY idClient DESC LIMIT 1";
    }

    public static function get_update_query_prepared(){
        return "UPDATE client SET nomClient = :nom, telephoneClient = :phone, statutClient = :statut WHERE idClient = :id";
    }

    public function get_update_values_prepared(){
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'phone' => $this->telephone,
            'statut' => $this->statut
        ];
    }

    public static function get_delete_query_prepared(){
        return "DELETE FROM client WHERE idClient = :id";
    }

    public static function get_delete_values_prepared($id){
        return [
            'id' => $id
        ];
    }
}

?>