<?php

class RendezVous {

    private $id_patient;
    private $dateRendezVous;
    private $heureRendezVous;

    public function __construct($date = "", $heure = "", $id = "") {
        $this->dateRendezVous = $date;
        $this->heureRendezVous = $heure;
        $this->id_patient = $id;
    }

    public function setIdPatient($id_patient) {
        $this->id_patient = $id_patient;
    }

    public function getIdPatient() {
        return $this->id_patient;
    }

    public function getDateRendezVous() {
        return $this->dateRendezVous;
    }

    public function getheureRendezVous() {
        return $this->heureRendezVous;
    }

    public function getRendezVous($connection) {

        $row = null;
        $query = "select  id_patient  from  rendezVous  where  date_rendezVous = " . "'$this->dateRendezVous'" . " and heure_rendezvous = " . "'$this->heureRendezVous'";
        $res = $connection->query($query);
        $row1 = 0;
        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $row1 = $this->getObjetPatient($connection, $row['id_patient']);
        }

        if ($row1 != 0)
            return $row1;
        return 0;
    }

    private function getObjetPatient($connection, $id) {
        $query = "select  *  from  users  where   id= $id ";
        $res = $connection->query($query);
        if ($res->num_rows > 0)
            return $res->fetch_assoc();
        return 0;
    }

    public function setRendezVous($connection) {


        $queryRendezVous = "Insert into rendezvous (id_patient,date_rendezVous,heure_rendezvous) "
                . "VALUES ( '" . $this->id_patient . "','" . $this->dateRendezVous . "','" . $this->heureRendezVous . "'   )";

        if ($connection->query($queryRendezVous) == true)
            return true;
        return false;
    }

}
