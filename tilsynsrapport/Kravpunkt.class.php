<?php
require_once '../div/database.php';

class Kravpunkt
{
    public $ordningsverdi;
    public $kravpunktnavn;
    public $karakter;
    public $tekst;

    public function __construct($data)
    {
        $this->ordningsverdi = $data['ordingsverdi'];
        $this->kravpunktnavn = $data['kravpunktnavn_no'];
        $this->karakter = $data['karakter'];
        $this->tekst = $data['tekst_no'];
    }

}

?>