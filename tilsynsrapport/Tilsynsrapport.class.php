<?php
require_once 'div/database.php';
require_once 'tilsynsrapport/Kravpunkt.class.php';

class Tilsynsrapport
{
    private $restaurant;
    private $tilsynid;
    private $sakref;
    private $status;
    private $dato;
    private $total_karakter;
    private $karakterer = "karakter";
    private $temabeskrivelser = "tema";
    private $tilsynsbesoektype;
    private $kravpunkter;
    
    public function __construct($tilsynid)
    {
        $data = $this->hentData($tilsynid);
        $this->restaurant = $this->restaurant($data['tilsynsobjektid']);
        $this->tilsyndid = $tilsynid;
        $this->sakref = $data['sakref'];
        $this->status = $data['status'];
        $this->dato = $data['dato'];
        $this->total_karakter = $data['total_karakter'];
        $this->karakterer = $this->karakterer($data, $this->karakterer);
        $this->temabeskrivelser = $this->temabeskrivelser($data, $this->temabeskrivelser);
        $this->tilsynsbesoektype = $data['tilsynsbesoektype'];
        $this->kravpunkter = $this->kravpunkter($tilsynid);
    }

    public function test()
    {
        echo (
            "restaurant $this->restaurant
            sakref $this->sakref, 
            status $this->status, 
            dato $this->dato, 
            total_karakter $this->total_karakter, 
            tilsynsbesøktype $this->tilsynsbesoektype"
        );
        echo " karakter1 ", $this->karakterer['karakter1'];
        echo " tema1_no ", $this->temabeskrivelser['tema1_no'];
        echo " kravpunkt1_1 ", $this->kravpunkter['1.1']->karakter;
    }

    private function hentData($tilsynid) 
    {
        $db = kobleOpp();
        $sql = ("SELECT * FROM Tilsynsrapporter WHERE tilsynid LIKE ?;");
        $stmt = mysqli_prepare($db, $sql);
        mysqli_stmt_bind_param($stmt, 's', $tilsynid);
        mysqli_stmt_execute($stmt);
        $data = mysqli_stmt_get_result($stmt);
        lukk($db);
        return mysqli_fetch_assoc($data);
    }

    private function restaurant($tilsynsobjektid)
    {
        $db = kobleOpp();
        $sql = "SELECT navn FROM Restauranter WHERE tilsynsobjektid LIKE ?";
        $stmt = mysqli_prepare($db, $sql);
        mysqli_stmt_bind_param($stmt, 's', $tilsynsobjektid);
        mysqli_stmt_execute($stmt);
        $data = mysqli_stmt_get_result($stmt);
        lukk($db);
        $data = mysqli_fetch_assoc($data);
        return $data['navn'];
    }

    private function karakterer($data, $key)
    {
        $tmp = [];
        for ($i = 1; $i <=4; $i++) 
        {
            $keyNavn = $key.$i;
            $tmp["$keyNavn"] = $data["$keyNavn"];
        }
        return $tmp;
    }
    
    private function temabeskrivelser($data, $key)
    {
        $tmp = [];
        for ($i = 1; $i <=4; $i++) 
        {
            $keyNavn = $key.$i."_no";
            $tmp["$keyNavn"] = $data["$keyNavn"];
        }
        return $tmp;
    }

    private function kravpunkter($tilsynid)
    {
        $kravpunkter = [];
        $data = $this->hentKravpunkter($tilsynid);
        foreach ($data as $kravpunkt) {
            $kravpunkter[$kravpunkt['ordingsverdi']] = new Kravpunkt($kravpunkt);
        }
        return $kravpunkter;
    }

    private function hentKravpunkter($tilsynid)
    {
        $db = kobleOpp();
        $sql = "SELECT * FROM Kravpunkter WHERE tilsynid LIKE ?";
        $stmt = mysqli_prepare($db, $sql);
        mysqli_stmt_bind_param($stmt, 's', $tilsynid);
        mysqli_stmt_execute($stmt);
        $data = mysqli_stmt_get_result($stmt);
        $data = $data->fetch_all(MYSQLI_ASSOC);
        lukk($db);
        return $data;
    }
}

?>