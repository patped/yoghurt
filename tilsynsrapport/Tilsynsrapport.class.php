<?php
require_once 'div/database.php';

class Tilsynsrapport
{
    private $restaurant;
    private $sakref;
    private $status;
    private $dato;
    private $karakterer = [];
    private $temabeskrivelser = [];
    private $tilsynsbesoektype;
    private $kravpunkter = [];
    
    public function __construct($tilsynid)
    {
        $data = $this->hentData($tilsynid);
        $this->sakref = $data['sakref'];
        $this->status = $data['status'];
        $this->dato = $data['dato'];
        $this->tilsynsbesoektype = $data['tilsynsbesoektype'];
    }

    public function test()
    {
        echo "sakref ", $this->sakref, " status ", $this->status, " dato ", $this->dato, " tilsynsbesøktype ", $this->tilsynsbesoektype;
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
}

?>