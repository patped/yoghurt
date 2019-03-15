<?php
require_once '../div/database.php';

class Kravpunkt {
    public $ordningsverdi;
    public $kravpunktnavn;
    public $karakter;
    public $tekst;

    public function __construct($data) {
        $this->ordningsverdi = $data['ordingsverdi'];
        $this->kravpunktnavn = $data['kravpunktnavn_no'];
        $this->karakter = "";
        $this->tekst = "";
    }

    public static function medData($data) {
        $kravpunkt = new self($data);
        $kravpunkt->karakter = $data['karakter'];
        $kravpunkt->tekst = $data['tekst_no'];
        return $kravpunkt;
    }

}

?>