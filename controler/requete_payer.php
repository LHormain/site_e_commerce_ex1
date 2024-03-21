<?php
$user = 'root';
$pass = '';

try {
    $bdd = new PDO('mysql:host=localhost;dbname=etoffe_en_ligne',$user,$pass); // concerne la base
}
catch(PDOException $e) {
    die('Erreur : '.$e->getMessage());
}

// déplace le panier dans commande
function req_panier_a_commande($bdd,$id_commande) {
    $requete = "INSERT INTO commandes (SELECT * FROM paniers WHERE id_commande = :id_commande)";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_commande', $id_commande, PDO::PARAM_INT);
    $req -> execute();
}
// enregistre le token pour la banque et l'associe au client et à la commande
function req_save_token($bdd,$id_commande,$jour,$token,$id_client,$montant_commande) {
    $requete = "INSERT INTO `referances_commandes` VALUES (:id_commande, :date_commande,:montant_commande, :token_commande,3, :id_client,1)";
    $req = $bdd -> prepare($requete);
    $req -> bindValue(':id_commande',$id_commande,PDO::PARAM_INT);
    $req -> bindValue(':date_commande',$jour,PDO::PARAM_INT);
    $req -> bindValue(':montant_commande',$montant_commande,PDO::PARAM_STR);
    $req -> bindValue(':token_commande',$token,PDO::PARAM_STR);
    $req -> bindValue(':id_client',$id_client,PDO::PARAM_INT);
    $req -> execute();
}
// mail pour co
function req_mail($bdd,$username) {
    $requete = "SELECT * FROM clients 
                WHERE mail_client = :username";  // version mail
    $req = $bdd->prepare($requete);
    $req -> bindValue(':username', $username, PDO::PARAM_STR);
    $req -> execute();

    $user = $req -> fetch();
    return $user;
}

if (isset($_POST['id_commande']),
            $_POST['token'],
            $_POST['mail_client'],
            $_POST['prix_livraison']
&& $_POST['id_commande'] != NULL
&& $_POST['token'] != NULL
&& $_POST['mail_client'] != NULL
&& $_POST['prix_livraison'] != NULL
) {
    $id_commande = htmlspecialchars($_POST['id_commande']);
    $token = htmlspecialchars($_POST['token']);
    $mail_client = htmlspecialchars($_POST['mail_client']);
    $prix_livraison = htmlspecialchars($_POST['prix_livraison']);
    $jour = time();

    $client = req_mail($bdd,$mail_client);
    // enregistre le token et la commande et le compte associé
    req_save_token($bdd,$id_commande,$jour,$token,$client['id_client'],$prix_livraison);

    // enregistrement de la commande
    req_panier_a_commande($bdd,$id_commande);
    
    // tuer la session id_commande quand paye.? lui donner un nouveau timestamps? 
    $_SESSION['id_commande'] = time();

    echo 'continue';

}


?>


<script>
    // btn_payer = document.getElementById('payer');
    // commande = document.getElementByName('id_commande');
    // token = document.getElementByName('token');
    // client = document.getElementByName('mail_client');
    // prix = document.getElementByName('prix_livraison');

    // btn_payer.addEventListener('click', function() {
    //     payerCommande(commande,token,client,prix);
    // });

    // function payerCommande(commande,token,client,prix) {
    //     const xmlhttp = new XMLHttpRequest();
    //     xmlhttp.open("POST", "controler/requete_payer.php", true);
    //     xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    //     xmlhttp.onload = function() {
    //         // envoie à la "banque"
    //         const myobj = this.responseText;
    //         if (myobj) {
    //             window.location.assign("../test/banque_test.php");
    //         }
    //      }

    //     data = ('id_commande=' + commande + '&token=' + token + '&mail_client=' + client +'&prix_livraison=' + prix);
    //     xmlhttp.send(data);
    // }
</script>