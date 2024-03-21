<?php
$user = 'root';
$pass = '';

try {
    $bdd = new PDO('mysql:host=localhost;dbname=etoffe_en_ligne',$user,$pass); // concerne la base
}
catch(PDOException $e) {
    die('Erreur : '.$e->getMessage());
}

//-------------------------------------------------
//              pour ajax sur panier
//-------------------------------------------------
// récupération des catégories 
if (isset($_POST['id_adresse'],
          $_POST['id_commande']) 
          && $_POST['id_adresse'] != NULL
          && $_POST['id_commande'] != NULL
    ) {
    $id_adresse = intval($_POST['id_adresse']);
    $id_commande = intval($_POST['id_commande']);
}
else {
    $id_adresse = 0;
    $id_commande = 0;
}
// recuperation de sous cat dans la bdd 
$requete = "UPDATE `referances_commandes`
            SET id_adresse = :id_adresse
            WHERE id_commande = :id_commande
                "; 
$req4 = $bdd->prepare($requete);
$req4->bindValue(':id_adresse', $id_adresse, PDO::PARAM_INT);
$req4->bindValue(':id_commande', $id_commande, PDO::PARAM_INT);
$req4 -> execute();
// $tableau_donnees = json_encode($req4->fetchAll());
// echo $tableau_donnees;
?>