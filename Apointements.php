<?php
session_start();

if (!isset($_SESSION['username'])) {  // pour protéger l'accée à la page par l'url.
    $_SESSION = array();
    session_destroy();
    header('Location: index.php');
}
if (isset($_POST['FermerSession'])) {
    // Détruit toutes les variables de la session
    $_SESSION = array();
    session_destroy(); // detruire la session en cours
    header('Location: index.php'); //redireger vers la page d'accueil
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>

        <meta charset="UTF-8">

        <title>Clinique médicale Des 2 Tours: information, prise de rendez-vous</title>
        <?php require_once 'entete.php'; ?>


        <script type="text/javascript">

            $(document).ready(function () {


                $("#idFermerTable").click(function () {

                    $('#idtableAffiche').hide(); //.css('visibility','hidden');


                });

            });
        </script>



        <!-- <div id="login">
     
         </div>-->
        <script type=text/javascript>
            $(document).ready(function () {

                $("#button").button();
                $("#submit").button();
                var valeurDate;

                $('#datepicker1').datepicker({
                    closeText: 'Fermer',
                    prevText: '&#x3c;Préc',
                    nextText: 'Suiv&#x3e;',
                    currentText: 'Aujourd\'hui',
                    monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin',
                        'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
                    monthNamesShort: ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Jun',
                        'Jul', 'Aou', 'Sep', 'Oct', 'Nov', 'Dec'],
                    dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
                    dayNamesShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
                    dayNamesMin: ['Di', 'Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa'],
                    weekHeader: 'Sm',
                    dateFormat: 'dd-mm-yy',
                    firstDay: 1,
                    isRTL: false,
                    showMonthAfterYear: false,
                    yearSuffix: '',
                    //minDate: -2,
                    maxDate: '+36M +0D',
                    numberOfMonths: 2,
                    showButtonPanel: true,
                    onSelect: function (date) {

                        valeurDate = date
                    },
                    beforeShowDay: $.datepicker.noWeekends,
                });

                $('#datepicker3').datepicker({
                    closeText: 'Fermer',
                    prevText: '&#x3c;Préc',
                    nextText: 'Suiv&#x3e;',
                    currentText: 'Aujourd\'hui',
                    monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin',
                        'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
                    monthNamesShort: ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Jun',
                        'Jul', 'Aou', 'Sep', 'Oct', 'Nov', 'Dec'],
                    dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
                    dayNamesShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
                    dayNamesMin: ['Di', 'Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa'],
                    weekHeader: 'Sm',
                    dateFormat: 'dd-mm-yy',
                    firstDay: 1,
                    isRTL: false,
                    showMonthAfterYear: false,
                    yearSuffix: '',
                    //minDate: -2,
                    maxDate: '+36M +0D',
                    numberOfMonths: 2,
                    showButtonPanel: true,
                    onSelect: function (date) {

                        valeurDate = date
                    },
                    beforeShowDay: $.datepicker.noWeekends,
                });

                $('#datepicker2').datepicker({
                    closeText: 'Fermer',
                    prevText: '&#x3c;Préc',
                    nextText: 'Suiv&#x3e;',
                    currentText: 'Aujourd\'hui',
                    monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin',
                        'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
                    monthNamesShort: ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Jun',
                        'Jul', 'Aou', 'Sep', 'Oct', 'Nov', 'Dec'],
                    dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
                    dayNamesShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
                    dayNamesMin: ['Di', 'Lu', 'Ma', 'Me', 'Je', 'Ve', 'Sa'],
                    weekHeader: 'Sm',
                    dateFormat: 'dd-mm-yy',
                    firstDay: 1,
                    isRTL: false,
                    showMonthAfterYear: false,
                    yearSuffix: '',
                    minDate: 0,
                    maxDate: '+36M +0D',
                    numberOfMonths: 2,
                    showButtonPanel: true,
                    onSelect: function (date) {

                        valeurDate = date
                    },
                    beforeShowDay: $.datepicker.noWeekends,
                });

                /*********** Fermer le tableau d'affichage des rendez-vous en semaine ****/
                $("#idFermerTableau").click(function () {
                    $("#idTableAffiche").hide();

                });

                $("#selectmenu1").selectmenu();
                $("#selectmenu2").selectmenu();
                $("#selectmenu3").selectmenu();
                $("#accordion").accordion();

                $("#idSubmitA").click(function () {
                    var wdate = $('#datepicker3').val();
                    var heure = $('#selectmenu3').val();
                     
                    $.post("GetRendezVous/getRendezVous.php", {dateR: wdate, heure: heure}, function (data, status) {

                        if (data["status"] == 1)
                        {
                            //       alert("Votre rendez-vous de " + wdate + " à " + heure + " " + data['nom'] + " " + data['prenom']);
                            var chaine = '<b>Nom: </b><span>' + data["nom"] + '</span><br/>';
                            chaine += '<b>Prénom: </b><span>' + data["prenom"] + '</span><br/>';
                            chaine += '<b>Adresse: </b><span">' + data['adresse'] + '</span><br/>';
                            chaine += '<b>Date: </b>' + wdate + '<br>';
                            chaine += '<b>Heure: </b>' + heure;
                        } else
                            var chaine = "Le rendez-vous de " + wdate + " à " + heure + " n'existe pas.";
                        $("#idMessageDialig").html(chaine);
                        $("#idDialog").attr("title", "Information rendez-vous");
                        $("#idDialog").dialog({
                            dialogClass: "no-close",
                            buttons: [
                                {
                                    text: "Fermer",
                                    click: function () {
                                        $(this).dialog("close");
                                    }
                                }
                            ]
                        });


                    });
                });



                $("#idSubmitL").click(function () {

                    var wdate = $('#datepicker2').val();
                    var idPatient = $('#idIdPatient').val();
                    var heure = $('#selectmenu1').val();

                    $.post("setRendezVous/setRendezVous.php", {dateR: wdate, heure: heure, idPatient: idPatient}, function (data, status) {

                        //alert(data["Etat"]);

                        if (data == 1) {
                            $("#idTableAffiche").hide();
                            var chaine = '<b>Votre rendez-vous de ' + wdate + ' à ' + heure + ' est enregistré.</b>';
                             } else  var chaine = '<b>Le rendez-vous de ' + wdate + ' à ' + heure + ' est déjà pris.</b>'
                            
                             $("#idMessageDialig").html(chaine);
                            $("#idDialog").attr("title", "Attention!");
                            $("#idDialog").dialog({
                                dialogClass: "no-close",
                                buttons: [
                                    {
                                        text: "Fermer",
                                        click: function () {
                                            $(this).dialog("close");
                                        }
                                    }
                                ]
                            });
                 });
                });
                /******************************Chercher les information d'utilisateur ****************/
/******************/

               
/******************/
                $("#idUtilisateur").click(function () {

                    var wusername = $('#idUsername').val();

                    $.post("GetUserInfoWithUsername/getUserInfoU.php", {username: wusername}, function (data, status)
                    {
                       
                        if (data["id"] > 0)
                        {
                            var chaine = '<b>Nom: </b><span>'   + data["nom"] + '</span><br/>';
                            chaine += '<b>Prénom: </b><span>'   + data["prenom"] + '</span><br/>';
                            chaine += '<b>Adresse: </b><span">' + data['adresse'] + '</span><br/>';
                            chaine += '<b>Username: </b>'       + data['username'] + '<br>';
                            chaine += '<b>Mot de passe: </b>' + data['password'];
                         
                        } else {var chaine = "Patient n'existe pas";}
                         
                         
                    $("#idMessageDialig").html(chaine);
                    
                    $("#idDialog").attr("title", "Information Utilisateur");
                    
                    $("#idDialog").dialog({
                        dialogClass: "no-close",
                        buttons: [
                            {
                                text: "Fermer",
                                click: function () {
                                    $(this).dialog("close");
                                }
                            }
                        ]
                    });
                    
                    
                    });
              });




                /**********************************fin ***********************************************/




            });


        </script>
    </head>
    <body>

        <?php
        require_once 'tools/db.php';
        require_once 'header.php';
        ?>

        <div id="idDialog" title="">
            <p id="idMessageDialig" >
            </p>
        </div>


        <div id="idInfoPatient">
            <img src="images/user-icon-6.png" width="200" height="150">
            <?php echo "<span>" . $_SESSION['prenom'] . " " . $_SESSION["nom"] . "</span>" ?>
            <form method="post">
                <div class="input-group" style='position:relative;top:-50px;margin-left:220px;'>
                    <input type="submit" class="btn btn-primary" name='FermerSession' title="Fermer votre session" value="Déconnexion">
                </div>
            </form>
        </div> 
        <!---------debut------------->

        <div id="accordion">
            <h3>Information sur un rendez-vous</h3>
            <div>

                <table>
                    <tbady>
                        <tr>
                            <td>Date  désirée:</td>
                            <td><input type="text" class="btn btn-primary" name="datePicker" id="datepicker3" value="<?php echo date('j-m-Y') ?>" ></td>
                        </tr>
                        <tr>
                            <td>Heure désirée:</td>
                            <td><select id="selectmenu3"  name="heure" >
                                    <option selected value="8:00">08H:00</option>
                                    <option value="09:00">09H:00</option>
                                    <option value="10:00">10H:00</option>
                                    <option value="11:00">11H:00</option>
                                    <option value="12:00">12H:00</option>
                                    <option value="13:00">13H:00</option>
                                    <option value="14:00">14H:00</option>
                                    <option value="15:00">15H:00</option>
                                    <option value="16:00">16H:00</option>
                                </select></td>
                            <td><input type="submit" class="btn btn-danger" id="idSubmitA" value="Afficher"></td>
                        </tr>


                    </tbady>

                </table>


            </div>

            <h3>Consulter les disponibilités</h3>
            <div>
                <div class="indicateurCouleur" style="position:relative; float:right; ">

                    <table>
                        <tr><td style="width: 20px; height: 20px; background:green;"></td>
                            <td> </td>
                            <td>Libre</td>

                        </tr>
                        <tr><td style="width: 20px; height: 20px; background:lightblue;"></td>
                            <td> </td>
                            <td>Pris</td>
                        </tr>

                        <tr><td  style="width: 20px; height: 20px; background:red"></td>
                            <td> </td>
                            <td>Écoulé</td>
                        </tr>
                    </table>

                </div>
                <form  method="post">
                    <table>
                        <tbody>
                            <tr><td>Date désirée:</td>
                                <td><input type="text" class="btn btn-primary" title="Clic pour choisir une date" name="dateDespo" id="datepicker1" value="<?php echo date('j-m-Y'); ?>" ></td>

                                <td> <input type="submit" class="btn btn-info" id="idSoumettre" title="Lancer la recherche" value="Soumèttre" ></td>
                            </tr>

                        </tbody>
                    </table>

                </form>
            </div>

            <h3>Prenez un rendez-vous</h3>
            <div>
                <input type="hidden" name="idPatient" id="idIdPatient" value="<?php echo $_SESSION['idPatient'] ?>"/>

                <table>
                    <tbady>
                        <tr>
                            <td>Date  désirée:</td>
                            <td><input type="text" class="btn btn-primary" name="datePicker" id="datepicker2" value="<?php echo date('j-m-Y') ?>" ></td>
                        </tr>
                        <tr>
                            <td>Heure désirée:</td>
                            <td><select id="selectmenu1"  name="heure" >
                                    <option selected value="8:00">08H:00</option>
                                    <option value="09:00">09H:00</option>
                                    <option value="10:00">10H:00</option>
                                    <option value="11:00">11H:00</option>
                                    <option value="12:00">12H:00</option>
                                    <option value="13:00">13H:00</option>
                                    <option value="14:00">14H:00</option>
                                    <option value="15:00">15H:00</option>
                                    <option value="16:00">16H:00</option>
                                </select></td>
                            <td><input type="submit" class="btn btn-info" id="idSubmitL" value="Enregistrer"></td>
                        </tr>


                    </tbady>

                </table>

            </div>
            <!-----------------Information Utilisateur ---------------->
            <h3>Information sur l'utilisateur</h3>
            <div>
                <div class="input-group" style="width:50%;">
                    <span class=" glyphicon glyphicon-user"  id="sizing-addon2" ></span>
                    <input type="text" class="form-control " id="idUsername" placeholder="Username" aria-describedby="sizing-addon2" required >
                </div>
                <input type="submit"  class="btn btn-primary"  id="idUtilisateur" value="Soumèttre">

            </div>
            <!-----------------Fin------------------------------------->
        </div>
        <!---------fin ------------->
        <?php
        if (isset($_POST['dateDespo'])) {
            $dateselect = strtotime($_POST['dateDespo']);
            $newformat = date('Y-m-j', $dateselect);
            $tabDays = array("Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi");
            $dw = date("w", $dateselect);
            $tabBusnissdays = getDateWeekdays($_POST['dateDespo']);
            $TabRendyvous = array();
            ?>

            <div class="panel panel-default" id="idTableAffiche" >
                <div class="panel-heading">
                    <span style="font-family: cursive; font-size: 20px;">Les rendez-vous en semaine<span id="idFermerTableau" class="glyphicon glyphicon-remove btn btn-warning" aria-hidden="true" style="font-size: 15px;position:relative;float: right;" ></span>

                </div>
                <div class="panel-body">

                    <table class="table table-hover table-bordered" >
                        <thead >
                            <tr style="background: graytext;color: whitesmoke;">
                                <th>Date\Heure</th>
                                <th>08H:00</th>
                                <th>09H:00</th>
                                <th>10H:00</th>
                                <th>11H:00</th>
                                <th>12H:00</th>
                                <th>13H:00</th>
                                <th>14H:00</th>
                                <th>15H:00</th>
                                <th>16H:00</th>
                                <?php ?>

                            </tr>
                        </thead>
                        <tbody >
                            <?php
                            $connection = connect_db();
                            $tabRendez_vous = tableRendez_Vous($tabBusnissdays, $connection);
                            disconnect_db($connection);

                            for ($i = 0; $i < 5; $i++) {
                                echo "<tr>";
                                echo "<td>" . $tabDays[$i + 1] . "<br>" . $tabBusnissdays[$i + 1] . "</td>";
                                for ($j = 0; $j <= 8; $j++) {
                                    $nbSecondeToDay = intval(strtotime(date("d-m-Y")));
                                    $nbSecondeDay = intval(strtotime($tabBusnissdays[$i + 1]));
                                    $variation = $nbSecondeToDay - $nbSecondeDay;

                                    if (!$tabRendez_vous[$i][$j]) {

                                        if ($variation > 0)
                                            echo "<td style='background:red' ></td>";
                                        else
                                            echo "<td style='background:green'></td>";
                                    } else {

                                        if ($variation > 0) {
                                            echo "<td class='clRFini'>" . $tabRendez_vous[$i][$j] . "</td>";
                                        } else
                                            echo "<td class='clRnonFini'>" . $tabRendez_vous[$i][$j] . "</td>";
                                    }
                                }

                                echo "</tr>";
                            }
                            ?>

                        </tbody>

                    </table>

                </div>
            </div>     
            <?php
        }
        ?>
    </body>
</html>


