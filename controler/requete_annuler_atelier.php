<?php
$user = 'root';
$pass = '';

try {
    $bdd = new PDO('mysql:host=localhost;dbname=etoffe_en_ligne',$user,$pass); // concerne la base
}
catch(PDOException $e) {
    die('Erreur : '.$e->getMessage());
}

if (isset($_POST['id_client'], $_POST['id_atelier'], $_POST['id_horaire'])
&& $_POST['id_client'] != NULL
&& $_POST['id_atelier'] != NULL
&& $_POST['id_horaire'] != NULL
){
    $id_client = intval($_POST['id_client']);
    $id_atelier = intval($_POST['id_atelier']);
    $id_horaire = intval($_POST['id_horaire']);

    // récupère les infos du client 
    $requete = "SELECT * FROM clients WHERE id_client = :id_client";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_client', $id_client, PDO::PARAM_INT);
    $req -> execute();
    $client = $req -> fetch();

    // récupère l'atelier 
    $requete = "SELECT * FROM ateliers WHERE id_atelier = :id_atelier";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_atelier', $id_atelier, PDO::PARAM_INT);
    $req -> execute();
    $atelier = $req -> fetch();

    //récupère l'heure
    $requete = "SELECT * FROM horaires WHERE id_horaire = :id_horaire";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_horaire', $id_horaire, PDO::PARAM_INT);
    $req -> execute();
    $date = $req -> fetch();

    $nom_contact = '\''.$client['prenom_client'].' '.$client['nom_client'].'\'';
    $mail_contact = '\''.$client['mail_client'].'\'';
    $tel_contact = '\''.$client['tel_client'].'\'';
    $entreprise_contact = '\''.'non renseigné'.'\'';
    $categorie_contact = '\''.'Annulation atelier'.'\'';
    $date_message = time();
    $message_contact = '\''.'client : '.$client['id_client'].' \r\n
                        atelier :'.$atelier['nom_atelier'].' \r\n
                        horaire : '.date('d-m-Y H:i',$date['date_atelier']).' \r\n
                        Demande une annulation le : '.date('d-m-Y H:i', $date_message).'\'';

    // enregistre la demande d’annulation dans contact
    
    $requete = "INSERT INTO `contacts`(`id_contact`, `nom_contact`, `mail_contact`, `tel_contact`, `entreprise_contact`, `categorie_contact`, `message_contact`, `date_message`, `lu_message`, `repondu_message`) 
                VALUES (0,$nom_contact,$mail_contact,$tel_contact,$entreprise_contact,$categorie_contact,$message_contact,$date_message,0,0)";
    $req = $bdd -> prepare($requete);
    $req -> execute();
    $sortie = 'annule';

    // change le boolean annuler dans inscription
    $requete = "UPDATE inscriptions SET annuler = 1 
                WHERE id_client = :id_client AND id_atelier = :id_atelier AND id_horaire = :id_horaire";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_client', $id_client, PDO::PARAM_INT);
    $req -> bindValue(':id_atelier', $id_atelier, PDO::PARAM_INT);
    $req -> bindValue(':id_horaire', $id_horaire, PDO::PARAM_INT);
    $req -> execute();

    // envoie mail à admin pour signaler la demande
    $mail = 'contact-atelier@etoffeenligne.com';
    $sujet = 'Annulation atelier';
    $message = $message_contact;
    $headers = "From : ".$client['mail_client']."\r\n";
    $headers .= "X-Mailer: PHP/".phpversion()."\r\n" ;
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-type: text/html; charset=UTF-8\r\n";
    $headers .= "Content-Transfer-Encoding: 8bit\r\n\r\n";

    // mail basique
    // mail($mail, $sujet, $message, $headers);

    // $sortie = json_encode($req -> fetchAll());
    // echo $sortie;
}

?>