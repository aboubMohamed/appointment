<?php

require_once "../tools/db.php";

class Patient {

    private $Id;
    private $nom;
    private $prenom;
    private $adresse;
    private $username;
    private $password;

    public function __construct($Id = "", $nom = "", $prenom = "", $adresse = "", $username = "", $password = "") {
        $this->Id = $Id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->adresse = $adresse;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * fonction de avoir le id de patient
     * @return type
     */
    public function getIdPatient() {
        return $this->Id;
    }

    public function getNomPatient() {
        return $this->nom;
    }

    public function getPrenomPatient() {
        return $this->prenom;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPassword($password) {
        $this->password = $password;
    }
    public function getPasswordPatient()
    {
        return $this->password;
    }
    public function getUsernamePatient() {
        return $this->username;
    }

    public function getAdressePatient() {
        return $this->adresse;
    }

    // Va chercher les infos du client dans la base de donnees et initialise le membres de la classe
    public function getPatient($idUtilisateur) {
        $connection = connect_db();
        $select1 = "SELECT * from users where Id = '" . $idUtilisateur . "'";
        $res = null;
        $res = $connection->query($select1);

        if ($res != null && $res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $this->Id = $row["id"];
            $this->username = $row["username"];
            $this->nom = $row["nom"];
            $this->prenom = $row["prenom"];
            $this->adresse = $row["adresse"];
        }
        disconnect_db($connection);
        return $res;
    }

    public function getLoginInfo() {
        $connection = connect_db();
        $res = null;
        $select = "SELECT * from users where username = '$this->username' and password='$this->password'";
        $res = $connection->query($select);
        if ($res != null && $res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $this->Id = $row["id"];
            $this->nom = $row["nom"];
            $this->prenom = $row["prenom"];
            $this->adresse = $row["adresse"];
        }
        disconnect_db($connection);
        return $res;
    }
    
    public function getUserWithUserName($username){
		$connection = connect_db();
                $res =null;
		$select = "SELECT * from users where username = '$username'";
                $res = $connection->query($select);
                if($res!=null && $res->num_rows>0)
                {
                $row = $res->fetch_assoc();
                $this->Id =$row["id"];
		$this->username = $row["username"];
                $this->nom = $row["nom"];
                $this->prenom = $row["prenom"];
                $this->adresse =$row["adresse"];
                $this->password = $row["password"];
                }
    
               disconnect_db($connection) ;
               return $res;
                
                }

    public function toJSON() {
        return json_encode($this);
    }

}

?>