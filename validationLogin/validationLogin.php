<?php

require_once '../classes/Patient.php';
require_once '../tools/db.php';
$username = test_input($_REQUEST["username"]);
$password = test_input($_REQUEST["password"]);
$patient = new Patient();
$patient->setUsername($username);
$patient->setPassword($password);
$res = $patient->getLoginInfo();
session_start();
if ($res != NULL && $res->num_rows > 0) {
    $_SESSION['idPatient'] = $patient->getIdPatient();
    $_SESSION['username'] = $patient->getUsernamePatient();
    $_SESSION['nom'] = $patient->getNomPatient();
    $_SESSION['prenom'] = $patient->getPrenomPatient();
    $message = array("status" => 1, "message" => "Bienvenue");
} else {
    $message = array("status" => -1, "message" => "Votre compte ou mot de passe est incorrect");
}
header("content-type: application/json");
echo json_encode($message);
?>
