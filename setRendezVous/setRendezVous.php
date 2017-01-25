<?php

require_once '../Classes/rendezVous.php';
require_once '../tools/db.php';
$wdate = $_REQUEST['dateR'];
$dateselect = strtotime($wdate);
$date_rendezVous = date('Y-m-j', $dateselect);
$heure_RendezVous = $_REQUEST['heure'];
$id_patient = $_REQUEST['idPatient'];
$objetRendezVous = new RendezVous($date_rendezVous, $heure_RendezVous, $id_patient);
$connection = connect_db();
$str = $objetRendezVous->setRendezVous($connection);
session_start();
$_SESSION["dateRendezVous"] = $wdate;
$_SESSION["heureRendezVous"] = $heure_RendezVous;
//header('Content-Type: application/json');
if ($str == true) {
    echo json_encode(1);
    $_SESSION["register"] = "TRUE";
} else {
    echo json_encode(0);
}

disconnect_db($connection);
?>

