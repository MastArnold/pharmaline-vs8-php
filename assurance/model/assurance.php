<?php

class Assurance{
    public string $code; // code_assurance
    public string $label; // libelle_assurance
    public float $percent; // pourcentage_pce
    public string $phone; // telephone_assurance
    public string $address; // adresse_assurance
    public string $ifu; // ifu

    public function __construct(string $code, string $label, float $percent, string $phone, string $address, string $ifu)
    {
        $this->code = $code;
        $this->label = $label;
        $this->percent = $percent;
        $this->phone = $phone;
        $this->address = $address;
        $this->ifu = $ifu;
    }

    public static function fromJSON(string $json){
        $data = json_decode($json, true);
        return new Assurance(
            $data['code'],
            $data['label'],
            $data['percent'],
            $data['phone'],
            $data['address'],
            $data['ifu']
        );
    }

    public static function get_select_all_query(){
        return "SELECT * FROM assurance ORDER BY code_assurance";
    }

    public static function get_select_search_query_prepared(){
        return "SELECT * FROM assurance WHERE code_assurance LIKE :code OR telephone_assurance LIKE :phone ORDER BY code_assurance";
    }

    public static function get_select_search_values_prepared(string $search){
        return [
            'code' => '%'.$search.'%',
            'phone' => '%'.$search.'%'
        ];
    }

    public static function get_select_byId_query_prepared(){
        return "SELECT * FROM assurance WHERE code_assurance = :code";
    }

    public static function get_select_byId_values_prepared(string $code){
        return [
            'code' => $code
        ];
    }

    public static function get_insert_query_prepared(){
        return "INSERT assurance(
                            code_assurance, 
                            libelle_assurance, 
                            pourcentage_pce, 
                            telephone_assurance, 
                            adresse_assurance, 
                            ifu) 
                VALUES (:code, :label, :percent, :phone, :address, :ifu);";
    }

    public function get_insert_values_prepared(){
        return [
            'code' => $this->code,
            'label' => $this->label,
            'percent' => $this->percent,
            'phone' => $this->phone,
            'address' => $this->address,
            'ifu' => $this->ifu
        ];
    }

    public static function get_update_query_prepared(){
        return "UPDATE assurance SET libelle_assurance = :label, pourcentage_pce = :percent, telephone_assurance = :phone, adresse_assurance = :address, ifu = :ifu WHERE code_assurance = :code";
    }

    public function get_update_values_prepared(){
        return [
            'code' => $this->code,
            'label' => $this->label,
            'percent' => $this->percent,
            'phone' => $this->phone,
            'address' => $this->address,
            'ifu' => $this->ifu
        ];
    }

    public static function get_update_code_query_prepared(){
        return "UPDATE assurance SET code_assurance = :code WHERE code_assurance = :oldCode";
    }

    public static function get_update_code_values_prepared($old_code, $code){
        return [
            'code' => $code,
            'oldCode' => $old_code
        ];
    }
}

?>