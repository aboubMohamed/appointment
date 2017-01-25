<?php

require_once '../tools/db.php';
require_once '../classes/rendezVous.php';
require_once '../classes/Patient.php';
$dateselect = strtotime($_REQUEST['dateR']);
$date_rendezVous = date('Y-m-j', $dateselect);
$heure_RendezVous = $_REQUEST['heure'];
$objetRendezVous = new RendezVous($date_rendezVous, $heure_RendezVous);
$connection = connect_db();
$row = 0;
$row = $objetRendezVous->getRendezVous($connection);
disconnect_db($connection);
if ($row != 0)
    $row["status"] = 1;
else
    $row = array("status" => -1);
header('Content-Type: application/json');
echo json_encode($row);
?>