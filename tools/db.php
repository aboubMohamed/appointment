<?php

function connect_db() {   //Fonction de connexion
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $db = "rendezvous";
    $conn = new mysqli($servername, $username, $password, $db);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

function disconnect_db($connection) { //fonction de deconnexion
    $connection->close();
}

/**
 * retoune un tableau contient les champs d'un patient 
 * @param type $connection
 * @param type $user
 * @param type $pswd
 * @return type
 */
function selectUser($connection, $user, $pswd) {
    $row = NULL;
    //$query = "select * from users where uname='".$user."' and pswd='".$pswd."'";
    $query = "select * from users where username='" . $user . "'";
    $res = $connection->query($query);
    if ($res != NULL) {
        $row = $res->fetch_array();
        if ($row[5] != $pswd)
            return NULL;
    }
    return $row;
}

/* * ************************ */

// Fonction d'enregistrement d'un client dans la table clients

function select_table($connection, $table, $order) {
    $query = "select * from " . $table . " order by " . $order;
    $res = $connection->query($query);
    if ($res != NULL)
        return $res;
    else
        echo "table est vide...";
    return null;
}

/**
 * FONCTION QUI RETOURNE L'ELEMENT SELECTIONNE
 * @param type $connection
 * @param type $table
 * @param type $elementTable
 * @param type $element
 * @param type $stringOrderBay
 * @return type
 */
function selectElement($connection, $table, $elementTable, $element, $stringOrderBay) {
    $res = NULL;
    $query = "select  *  from  " . $table . "  where  " . $elementTable . " = " . "'$element'" . "  " . "$stringOrderBay";
    $res = $connection->query($query);
    return $res;
}

/**
 * Formater les données entrées par le formulaire (username et password)
 * @param type $data
 * @return type
 */
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

/**
 * FONCTION RETURN UN TABLEAU DES DATE DE LA SEMAINE 
 * @param type $date
 * @return type
 */
function getDateWeekdays($date) {
    $datetable = explode("-", $date); // convertir une chaine en array comme split en javascript.
    $d = intval($datetable[0]);
    $m = intval($datetable[1]);
    $y = intval($datetable[2]);
    $numDays = cal_days_in_month(CAL_GREGORIAN, $m, $y); // retourne le nombre de jours par mois.
    $tabDays = array();
    $dateselect = strtotime($date);
    $dw = date("w", $dateselect); // numero de jour dans semaine.
    $tabDays[$dw] = date($date);
    $yesMonth = false;
    $yesYear = false;
    for ($j = $dw + 1, $i = 1; $j <= 5; $j++, $i++) {

        $newDay = $d + $i;
        if ($newDay > $numDays) {
            $newDay = $newDay % $d;
            if ($yesMonth == FALSE) {
                $m++;
                $yesMonth = TRUE;
            }
            if ($m > 12) {
                $m = $m % 12;
                if ($yesYear == FALSE) {
                    $y++;
                    $yesYear = TRUE;
                }
            }
        }
        $tabDays[$j] = date(strval($newDay) . "-" . strval($m) . "-" . strval($y));
    }

    for ($j = $dw - 1, $i = 1; $j >= 1; $j--, $i++) {
        $newDay = $d - $i;
        $yes = false;
        if ($newDay <= 0) {
            $m--;
            if ($m == 0) {
                if ($yes == false) {
                    $m = 12;
                    $y--;
                    $yes = true;
                }
            }
            $dateselect = strtotime("1-" . strval($m) . "-" . strval($y));
            $numDays = cal_days_in_month(CAL_GREGORIAN, $m, $y);
            $i = 0;
            $d = $numDays;
            $newDay = $numDays - $i;
        }
        $tabDays[$j] = date(strval($newDay) . "-" . strval($m) . "-" . strval($y));
    }
    //var_dump($tabDays);
    return $tabDays;
}

/**
 *          * FONCTION RETURN LE NOMBRE DE JOURS PAR MOIS
 */
function DaysInMonth($dt) {
    $datetable = explode("-", $dt);
    $m = intval($datetable[1]);
    $y = intval($datetable[2]);
    $numDays = cal_days_in_month(CAL_GREGORIAN, $m, $y);
    return $numDays;
}

/**
 * Fonction qui retoune une matrice de tableau des rendez-vous.
 * @param type $tabBusnissdays
 * @param type $connection
 * @return type
 */
function tableRendez_Vous($tabBusnissdays, $connection) {
    $tabReturn = array(0, 0, 0, 0, 0);
    for ($j = 0; $j < 5; $j++) {
        $strdate = $tabBusnissdays[$j + 1];
        $dateselect = strtotime($strdate);
        $newformat = date('Y-m-d', $dateselect);

        $resultat = selectElement($connection, "rendezvous", "date_rendezvous", $newformat, "ORDER BY heure_RendezVous");

        if ($resultat != null && $resultat->num_rows != 0) {

            $tabRendezVousInDay = RendezVousParJour($resultat, $connection);
            //
            $tabReturn[$j] = $tabRendezVousInDay;
        }
    }
    //var_dump($tabReturn);    
    return $tabReturn;
}

/**
 * Fonction retourne les rendez-vous à une date donnee (tous les rendez-vous pris par jour)
 * @param type $resultat
 * @param type $connection
 * @return string
 */
function RendezVousParJour($resultat, $connection) {

    $tabRendezVousInDay = array(0, 0, 0, 0, 0, 0, 0, 0, 0);
    $indice = 0;
    while ($row = $resultat->fetch_array()) {
        $res = selectElement($connection, "users", "id", $row[1], "");
        $tab = $res->fetch_assoc();
        $nom = $tab['prenom'] . '<br/>' . $tab['nom'];
        //echo $row[3];

        switch ($row[3]) {
            case '08:00:00' : $tabRendezVousInDay[0] = $nom;
                break;
            case '09:00:00' : $tabRendezVousInDay[1] = $nom;
                break;
            case '10:00:00' :$tabRendezVousInDay[2] = $nom;
                break;
            case '11:00:00' :$tabRendezVousInDay[3] = $nom;
                break;
            case '12:00:00' :$tabRendezVousInDay[4] = $nom;
                break;
            case '13:00:00' :$tabRendezVousInDay[5] = $nom;
                break;
            case '14:00:00' :$tabRendezVousInDay[6] = $nom;
                break;
            case '15:00:00' :$tabRendezVousInDay[7] = $nom;
                break;
            case '16:00:00' :$tabRendezVousInDay[8] = $nom;
                break;
        }
    }
    return $tabRendezVousInDay;
}
