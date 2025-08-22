<?php

class Utilisateur{
    public string $id; //idUtilisateur
    public string $nom; //nomUtilisateur
    public string $prenom; //prenomUtilisateur
    public string $telephone; //telephoneUtilisateur
    public string $email; //emailUtilisateur
    public int $statut; //statutUtilisateur

    public function __construct(string $id, string $nom, string $prenom, string $telephone, string $email, int $statut)
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->statut = $statut;
    }

    public static function fromJson(string $json){
        $data = json_decode($json, true);
        return new Utilisateur($data['id'], $data['nom'], $data['prenom'], $data['telephone'], $data['email'], $data['statut']);
    }

    public static function get_select_query_prepared(){
        return "SELECT idUtilisateur, nomUtilisateur, prenomUtilisateur, telephoneUtilisateur, emailUtilisateur, statutUtilisateur FROM utilisateur";
    }

    public static function get_select_byId_query_prepared(){
        return "SELECT idUtilisateur, nomUtilisateur, prenomUtilisateur, telephoneUtilisateur, emailUtilisateur, statutUtilisateur FROM utilisateur WHERE idUtilisateur = :id";
    }

    public static function get_values_id($id){
        return [
            'id' => $id
        ];
    }

    public static function get_insert_query_prepared(){
        return "INSERT INTO utilisateur(idUtilisateur, nomUtilisateur, prenomUtilisateur, telephoneUtilisateur, emailUtilisateur, statutUtilisateur) VALUES (:id, :nom, :prenom, :telephone, :email, :statut);";
    }

    public function get_all_values(){
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'prenom' => $this->prenom,
            'telephone' => $this->telephone,
            'email' => $this->email,
            'statut' => $this->statut
        ];
    }

    public static function get_update_query_prepared(){
        return "UPDATE utilisateur SET nomUtilisateur = :nom, prenomUtilisateur = :prenom, telephoneUtilisateur = :telephone, emailUtilisateur = :email, statutUtilisateur = :statut WHERE idUtilisateur = :id;";
    }

    public static function get_inactive_query_prepared(){
        return "UPDATE utilisateur SET statutUtilisateur = 1 WHERE idUtilisateur = :id";
    }

    public static function get_active_query_prepared(){
        return "UPDATE utilisateur SET statutUtilisateur = 0 WHERE idUtilisateur = :id";
    }

    public static function get_delete_query_prepared(){
        return "DELETE FROM utilisateur WHERE idUtilisateur = :id;";
    }

}

?>