<?php
if (isset($_REQUEST["contactName"], $_REQUEST["contactEmail"])) {
    $subject = "Contact";
    $contactName = $_REQUEST["contactName"];
    $contactEmail = urldecode($_REQUEST["contactEmail"]);
    $contactMessage = $_REQUEST["contactMessage"];
    mail("mohbouaboub@gmail.com", $subject, "Message from: $contactName : " . $contactMessage, "From: $contactEmail\n");
    echo "Thank you! We will reply soon!";
}
?>


<!doctype html>
<html>
    <head>
        <?php require_once 'entete.php'; ?>
        <title>Clinique médicale Montréal - Nous joindre</title>
    </head>
    <body>
        <?php include 'header.php'; ?>
        <div class="panel panel-default" id="idContactSection">
            <div class="panel-heading">
                <h3  style="font-family: cursive;">NOUS JOINDRE</h3>
            </div>
            <div class="panel-body">
                <iframe width="96%" style="margin-left: 2%;" height="275" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" 
                        src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=fr&amp;geocode=&amp;q=1001+Boulevard+Robert-Bourassa,+Montr%C3%A9al,+QC+H3B+4L5,+Canada&amp;aq=&amp;sll=45.502256,-73.590889&amp;sspn=0.092883,0.172863&amp;ie=UTF8&amp;hq=&amp;hnear=1001+Boulevard+Robert-Bourassa,+Montr%C3%A9al,+Qu%C3%A9bec+H3B+4L5,+Canada&amp;t=m&amp;ll=45.502136,-73.563938&amp;spn=0.021055,0.036478&amp;z=14&amp;iwloc=near&amp;output=embed">

                </iframe>
                <div id="idcontactInfo">
                    <h4 style="font-family: cursive;">LA CLINIQUE MÉDICALE DES 2 TOURS</h4>
                    <h5>1001, Boul. Robert-Bourassa <br>
                        Niveau A, Local C-14<br>
                        Montréal, QC, H3B 4L4<br/>
                        Télephone: 514.954.4444

                    </h5>

                </div>
                <div id="idContactEmail">

                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" name="contactName" placeholder="Nom" />
                        </div>

                        <div class="input-group">
                            <input type="email" class="form-control" name="contactEmail" placeholder="Courriel" />
                        </div>

                        <div class="input-group">
                            <textarea name="contactMessage" width="200" class="form-control" rows="5" placeholder="Message ou commentaires" ></textarea>
                        </div>


                        <input type="submit" class="btn btn-primary pull-left" value="Envoyer" onclick="javascript:alert('en phase de développement!');"/>
                    </div>

                </div>
            </div>
        </div>


    </body>

</html>