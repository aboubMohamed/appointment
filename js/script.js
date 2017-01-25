$(document).ready(function () {

    $("#idRendezVous").click(function () {
        //Afficher la fenetre de connexion (login)
        $("#idLoginPage").show();
    });

    $("#idFermerFenetre").click(function () {
        //fermer la fenetre de connexion (login)
        $("#idLoginPage").hide();
    });

    $("#idConnexion").click(function () {
        //Afficher la fenetre de connexion (login)
        $("#idLoginPage").show();
    });

    $("#idAccueil").click(function () {

        location.href = "index.php";
    });

    $("#idNousJoindre").click(function () {

        location.href = "contact.php";
    });


    $("#name_submit").click(function () {

        var usernameVal = $("#username").val();
        var passwordVal = $("#password").val();
        $.post("validationLogin/validationLogin.php", {username: usernameVal, password: passwordVal},
                function (data, status)
                {
                    if (data["status"] == 1)
                    {
                        location.href = "Apointements.php";

                    } else {

                        alert(data["message"]);
                    }
                });


    });



});

function afficherDiv(position)
{

    switch (position)
    {                //Fermer la fenetre de connexion 
        case '1' :
            document.getElementById("idLoginPage").style.display = "none";
            break;
        case '2' :
            break;

        case '3' :
            fermerTousDiv();
            afficheLoginDiv();
            break;
            //Afficher 
        case '4' :
            fermerTousDiv();
            document.getElementById("idFooterJumbotron").style.display = "none";
            document.getElementById("idContact").style.display = "block";
            break;

        case '5' :

            break;
    }


}

function fermerTousDiv()
{

    document.getElementById("idContact").style.display = "none";
    document.getElementById("idBlocImages").style.display = "none";
    document.getElementById("idLoginPage").style.display = "none";

}

function afficheLoginDiv()
{
    document.getElementById("myCarousel").style.display = "block";
    document.getElementById("idBlocImages").style.display = "block";
    document.getElementById("idLoginPage").style.display = "block";
}


function chargerPageAccueil()
{
    location.href = "index.php";
}

  