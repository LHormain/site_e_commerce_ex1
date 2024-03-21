<?php
// récupère toute les commandes payer et avec payement refusé
if (isset($_GET['id']) && $_GET['id'] != NULL) {
    $id_client = intval($_GET['id']);

    $req_where = "WHERE clients.id_client = :id_client";
}
else {
    $req_where = "";
    $id_client = '';
}
if (isset($_GET['ordre']) && $_GET['ordre'] != NULL) {
    $ordre = intval($_GET['ordre']);

    if ($ordre == 1) {
        $req_ordre = "ORDER BY clients.nom_client";
    }
    elseif ($ordre == 2) {
        $req_ordre = "ORDER BY referances_commandes.id_commande";
    }
    elseif ($ordre == 3) {
        $req_ordre = "ORDER BY referances_commandes.date_commande";
    }
    elseif ($ordre == 4) {
        $req_ordre = "ORDER BY referances_commandes.id_etat_commande";
    }
    elseif ($ordre == 5) {
        $req_ordre = "ORDER BY referances_commandes.id_livraison";
    }
    else {
        $req_ordre = "ORDER BY referances_commandes.date_commande";
    }
}
else {
    $req_ordre = "ORDER BY referances_commandes.date_commande";
}
// toutes les commandes
$donnees = req_commandes_effectuee($bdd,$id_client,$req_where,$req_ordre);
$table = table_commandes($bdd, $donnees);
?>