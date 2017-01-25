<?php

function connect_db() 
{

        $servername = "localhost";
	$username = "root";
	$password = "";
	$db="rendezvous";
//*/
	// Create connection
	$conn = new mysqli($servername, $username, $password, $db);

	// Check connection
	if($conn->connect_error){
		die("Connection failed: ". $conn->connect_error);
	}
//echo "Connected successfully to " . var_dump($conn)."<br>";
	
	return $conn;
}


function disconnect_db($connection) 
{
	$connection->close();
//	echo "Disconnected successfully";
}


function test_input($data)
{
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}



function register_PatientObjet($connection, $objet) {
    $queryRendezVous = "Insert into patients (id_patient,date_rendezVous,heure_rendezvous) "
            . "VALUES ( '" . $objet->getProperty() . "','" . $objet->getdate() . "','" . $objet->getheure() . "'   )";

    if ($connection->query($queryRendezVous) === TRUE) {
        
        //echo "Entregistrement reussi..";
    } else {
        echo "Error: " . $queryRendezVous . "<br>" . $connection->error;
        
    }


   
}



function selectPatient($connection, $table, $date_rendezVous, $heure_RendezVous) {
    
    $res=NULL;
    $query = "select  *  from  " . $table . "  where  date_rendezVous = " . "'$date_rendezVous'" . " and heure_rendezvous = " .
            "'$heure_RendezVous'";

    $res = $connection->query($query);
   
    return $res;
}

function selectUser($connection, $user, $pswd) {
    $row = NULL;
    //$query = "select * from users where uname='".$user."' and pswd='".$pswd."'";
    $query = "select * from users where username='" . $user . "'";
    $res = $connection->query($query);
    if ($res->num_rows!=0) {
        $row = $res->fetch_array();
        if ($row[5] != $pswd)
            return NULL;
    }
    return $row;
}

/* * ************************ */

function select_table($connection, $table, $order) {
    $query = "select * from " . $table . " order by " . $order;
    //$query = "select * from .'$table'.order by.'$order'";
    $res = $connection->query($query);
    if ($res != NULL)
        return $res;
    else
        echo "table est vide...";
    return null;
}

function selectElement($connection, $table, $elementTable, $element,$stringOrderBay) {
    $query = "select  *  from  " . $table . "  where  " . $elementTable . " = " . "'$element'"."  "."$stringOrderBay"; 
    //echo $query;
    //return;
    $res = $connection->query($query);
    
    //var_dump($res);
    //echo $res->fetch_array()[2];
    //return;
    if ($res != NULL)
        return $res;
    else
        echo "table est vide...";
    return null;
}

