<?php
$reponse = array("id" => -1);
if (isset($_REQUEST['username'])) {
    require_once "../Classes/Patient.php";
    $username = $_REQUEST["username"];
    $patient = new Patient();
    $res = $patient->getUserWithUserName($username);
    if($res!=null || $res->num_rows>0)
    {
        $reponse["id"] = $patient->getIdPatient();
        $reponse["nom"] = $patient->getNomPatient();
        $reponse["prenom"] = $patient->getPrenomPatient();
        $reponse["adresse"] = $patient->getAdressePatient();
        $reponse["username"] =$patient->getUsernamePatient();
        $reponse["password"] =$patient->getPasswordPatient();
        
    }
}

header('Content-Type: application/json');

echo json_encode($reponse);

?>