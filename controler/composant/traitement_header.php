<?php
// badge pour panier
$nbr_produits = array('nbr'=> 0);
$panier_en_cour = htmlspecialchars($_SESSION['id_commande']);

$requete = "SELECT COUNT(id_panier) AS nbr FROM paniers WHERE id_commande = :id_commande";
$req = $bdd->prepare($requete);
$req -> bindValue(':id_commande', $panier_en_cour, PDO::PARAM_INT);
$req -> execute();

$nbr_produits = $req -> fetch();

?>