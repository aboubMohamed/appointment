<?php require_once 'entete.php'; ?>

<div id="idMenuP">

    <ul >
        <?php
        if (!isset($_SESSION['username'])) {
            echo "<li id='idAccueil'>Accueil</li>";
            echo "<li id='idNousJoindre'>Nous joindre</li>";
            echo "<li id='idConnexion'>Connexion</li>";
        }
        ?>

    </ul>

</div>

<div id="idMenuS">
    <a href="javascript:chargerPageAccueil()"><img src="images/logo.png"></a>
    <ul >
        <li>Prise de sang</li><span>| </span>
        <li>Services infirmiers</li><span>| </span>
        <li>Ostéopathie</li><span>| </span>
        <li>Perte de poids</li>

    </ul>

</div>

<div id="idLoginPage" >

    <div  id="idDivLogin">
        <div class="panel panel-warning">
            <div class="panel-heading"><strong>Connexion</strong>
            </div>
            <div class="panel-body">

                <div class="input-group">
                    <span class=" glyphicon glyphicon-user"  id="sizing-addon2" ></span>
                    <input type="text" class="form-control " id="username" name="username" placeholder="Username" aria-describedby="sizing-addon2" required >
                </div>
                <div class="input-group">
                    <span class=" glyphicon glyphicon-star" id="sizing-addon2"></span>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Mot de passe" aria-describedby="sizing-addon2" required>
                </div><br>

                <input type="submit"  class="btn btn-primary"  id="name_submit" value="S'identifier">
                <input type="button"  class="btn btn-danger" value="Fermer" id="idFermerFenetre">

            </div>
        </div>
    </div>

</div>


