<?php

require_once 'Tilsynsrapport.class.php';

$tilsynsid = "Z1601051650524980239IQFAN_TilsynAvtale";
$test = new Tilsynsrapport($tilsynsid);

$test->test();

?>