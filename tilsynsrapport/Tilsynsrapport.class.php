<?php
require_once '../div/database.php';
require_once 'Kravpunkt.class.php';

class Tilsynsrapport {
    public $restaurant = "Ny tilsynsraport";
    public $tilsynsobjektid = "";
    public $tilsynid = "";
    public $sakref = "";
    public $status = "";
    public $dato = "";
    public $total_karakter = "";
    public $karakterer;
    public $temaer;
    public $tilsynsbesoektype = "";
    public $kravpunkter;

    // Konstruktører og hjelpekunstruktører.
    public function __construct() {
        $this->karakterer = array(
            "karakter1"=>"",
            "karakter2"=>"",
            "karakter3"=>"",
            "karakter4"=>""
        );
        $this->temaer = $this->temaer();
        $this->kravpunkter = $this->tomKravpunkter();
    }

    public static function medTilsynid($tilsynid) {
        // Sjekker om tilsynsrapport-objektet allerede eksisterer.
        if (isset($_SESSION['tilsynsrapport'])) {
            $tilsynsrapport = unserialize($_SESSION['tilsynsrapport']);
            if ($tilsynid == $tilsynsrapport->tilsynid) {
                // Lager et nytt objekt hvis objektet er mer enn 10 min gammelt.
                if (isset($_SESSION['tilsynsrapport_levetid']) && (time() - $_SESSION['tilsynsrapport_levetid']) > 600) {
                    unset($_SESSION['tilsynsrapport_levetid']);
                    unset($_SESSION['tilsynsrapport']);
                    $tilsynsrapport = Tilsynsrapport::medTilsynidKonstruktor($tilsynid);
                    $_SESSION['tilsynsrapport'] = serialize($tilsynsrapport);
                    $_SESSION['tilsynsrapport_levetid'] = time();
                }
                return $tilsynsrapport;
            }
        }
        $tilsynsrapport = Tilsynsrapport::medTilsynidKonstruktor($tilsynid);
        $_SESSION['tilsynsrapport'] = serialize($tilsynsrapport);
        $_SESSION['tilsynsrapport_levetid'] = time();
        return $tilsynsrapport;
    }
    
    private static function medTilsynidKonstruktor($tilsynid) {
        $tilsynsrapport = new self();
        $data = $tilsynsrapport->hentData($tilsynid);
        if (!$data) {
            return $tilsynsrapport;
        }
        $tilsynsrapport->restaurant = $tilsynsrapport->restaurant($data['tilsynsobjektid']);
        $tilsynsrapport->tilsynsobjektid = $data['tilsynsobjektid'];
        $tilsynsrapport->tilsynid = $tilsynid;
        $tilsynsrapport->sakref = $data['sakref'];
        $tilsynsrapport->status = $data['status'];
        $tilsynsrapport->dato = $data['dato'];
        $tilsynsrapport->total_karakter = $data['total_karakter'];
        $tilsynsrapport->karakterer = $tilsynsrapport->karakterer($data);
        $tilsynsrapport->tilsynsbesoektype = $data['tilsynsbesoektype'];
        $tilsynsrapport->kravpunkter = $tilsynsrapport->kravpunkter($tilsynid);
        return $tilsynsrapport;
    }

    public static function medTilsynobjektid($tilsynsobjektid) {
        $tilsynsrapport = new self();
        $tilsynsrapport->restaurant = $tilsynsrapport->restaurant($tilsynsobjektid);
        $tilsynsrapport->tilsynsobjektid = $tilsynsobjektid;
        return $tilsynsrapport;
    }

    //Aplikasjonsmetoder
    public function dato() {
        $dato = $this->dato;
        if (strlen($dato) > 7) {
            $dato = substr($dato,0,2).".".substr($dato,2,2).".".substr($dato,4,4);
        } else {
            $tmp = substr($dato,0,1).".".substr($dato,1,2).".".substr($dato,3,4);
            $dato = "0".$tmp;
        }
        return $dato;
    }

    // Private klassefunksjoner
    private function hentData($tilsynid) {
        $db = kobleOpp();
        $sql = ("SELECT * FROM Tilsynsrapporter WHERE tilsynid LIKE ?;");
        $stmt = mysqli_prepare($db, $sql);
        mysqli_stmt_bind_param($stmt, 's', $tilsynid);
        mysqli_stmt_execute($stmt);
        $data = mysqli_stmt_get_result($stmt);
        lukk($db);
        return mysqli_fetch_assoc($data);
    }

    private function restaurant($tilsynsobjektid) {
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

    private function karakterer($data) {
        $karakterer = array_intersect_key($data + $this->karakterer, $this->karakterer);
        return $karakterer;
    }
    
    private function temaer() {
        $db = kobleOpp();
        $sql = "SELECT DISTINCT `tema1_no`, `tema2_no`, `tema3_no`, `tema4_no` FROM `Tilsynsrapporter` WHERE `tema1_no` IS NOT NULL AND  `tema2_no` IS NOT NULL AND `tema3_no`  IS NOT NULL AND `tema4_no` IS NOT NULL";
        $data = mysqli_query($db, $sql);
        $data = mysqli_fetch_assoc($data);
        lukk($db);
        return $data;
    }

    private function kravpunkter($tilsynid) {
        $kravpunkter = [];
        $data = $this->hentKravpunkter($tilsynid);
        foreach ($data as $kravpunkt) {
            $kravpunkter[$kravpunkt['ordingsverdi']] = Kravpunkt::medData($kravpunkt);
        }
        return $kravpunkter;
    }

    private function tomKravpunkter() {
        $data = $this->hentTomKravpunkter();
        $kravpunkter = [];
        foreach ($data as $kravpunkt) {
            $kravpunkter[$kravpunkt['ordingsverdi']] = new Kravpunkt($kravpunkt);
        }
        return $kravpunkter;
    }

    private function hentTomKravpunkter() {
        $db = kobleOpp();
        $sql = "SELECT DISTINCT ordingsverdi, kravpunktnavn_no FROM Kravpunkter ORDER BY SUBSTRING(ordingsverdi, 1 , 1), LENGTH(ordingsverdi), ordingsverdi";
        $kravpunkter = mysqli_query($db, $sql);
        $kravpunkter->fetch_all(MYSQLI_ASSOC);
        lukk($db);
        
        return $kravpunkter;
    }

    private function hentKravpunkter($tilsynid) {
        $db = kobleOpp();
        // Bruker ORDER BY LENGTH(k.ordingsverdi), k.ordingsverdi for å få ordningsverdiene i riktig rekkefølge.
        //$sql = "SELECT * FROM Kravpunkter AS k WHERE k.tilsynid LIKE ? ORDER BY LENGTH(k.ordingsverdi), k.ordingsverdi";
        $sql = "SELECT DISTINCT * FROM Kravpunkter WHERE tilsynid LIKE ?  ORDER BY SUBSTRING(ordingsverdi, 1 , 1), LENGTH(ordingsverdi), ordingsverdi";
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