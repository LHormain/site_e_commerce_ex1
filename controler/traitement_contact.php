<?php
$date_message = time();
$texte_page_courante = '';

if (isset($_POST['nom_contact'],
          $_POST['mail_contact'],
          $_POST['categorie_contact'],
          $_POST['message_contact']
)
&& $_POST['nom_contact'] != NULL
&& $_POST['mail_contact'] != NULL
&& $_POST['categorie_contact'] != NULL
&& $_POST['message_contact'] != NULL
) {
    $nom_contact = htmlspecialchars($_POST['nom_contact']);
    $mail_contact = htmlspecialchars($_POST['mail_contact']);
    $categorie_contact = htmlspecialchars($_POST['categorie_contact']);
    $message_contact = htmlspecialchars($_POST['message_contact']);
    $tel_contact = htmlspecialchars($_POST['tel_contact']); // pas obligatoire à conserver? 
    if ($tel_contact == '') { $tel_contact = 'non renseigné';}
    $entreprise_contact = htmlspecialchars($_POST['entreprise_contact']); // pas obligatoire à conserver? 
    if ($entreprise_contact == '') { $entreprise_contact = 'non renseigné';}

    // enregistre en base de donnée
    req_contact($bdd,$date_message,$nom_contact,$mail_contact,$tel_contact,$entreprise_contact,$categorie_contact,$message_contact);

    // envoie par mail à l'admin
    $mail = $mail_site;

    $sujet = $nom_site.': '.$categorie_contact;

    $message = 'Vous avez reçus un nouveau message de '.$nom_contact.'. <br> Le '.date('d-m-Y à H:i', $date_message).' : <br><br>'.$message_contact;

    $headers = "From : ".$mail_contact."\r\n";
    $headers .= "X-Mailer: PHP/".phpversion()."\r\n" ;
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "Content-Transfer-Encoding: 8bit\r\n\r\n";

    // mail basique
    // mail($mail, $sujet, $message, $headers);



    $texte_page_courante = 'Votre message a été envoyé avec succès. Notre équipe traitera votre demande dans les plus brefs délais. <br> Merci de nous avoir contactés.';
}
else {
    $texte_page_courante = 'Une erreur est survenue. Veuillez réessayer ultérieurement. ';
}


?>