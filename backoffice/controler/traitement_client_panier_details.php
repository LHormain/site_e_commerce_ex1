<?php
$fac = 0;

if (isset($_GET['com']) && $_GET['com'] != NULL) {
    $id_commande = intval($_GET['com']);

    $titre = 'Commande n° '.$id_commande;
    $donnees = req_produits_commande($bdd,$id_commande);
    $produits = $donnees[1];
    $date = req_date_commande($bdd,$id_commande);
    
    $sortie = table_detail_panier($bdd,$produits);
    $poids_total = $sortie['3'];
    $client = $sortie[0];
    $table = $sortie[1];
    $prix_tot = $sortie[2];
    $remise = $prix_tot*5/100;
    $tva = ($prix_tot-$remise)*20/100;
    $livraison = 2+ 0.001*$poids_total;
    $adresse_livraison = req_livraison($bdd,$id_commande);
}
elseif (isset($_GET['pan']) && $_GET['pan'] != NULL) {
    $id_panier = intval($_GET['pan']);

    $titre = 'Panier n° '.$id_panier;
    $donnees =req_panier_ligne($bdd,$id_panier);
    $date = time();

    $sortie = table_detail_panier($bdd,$donnees);
    $client = $sortie[0];
    $table = $sortie[1];
    $prix_tot = $sortie[2];
    $remise = $prix_tot*5/100;
    $tva = ($prix_tot-$remise)*20/100;
    $livraison = 0;
    $adresse_livraison = '';
}
elseif (isset($_GET['fac']) && $_GET['fac'] != NULL) {
    $id_commande = intval($_GET['fac']);
    $fac = 1;
    $date = req_date_commande($bdd,$id_commande);

    $titre = 'Commande n° '.$id_commande;
    $donnees = req_produits_commande($bdd,$id_commande);
    $produits = $donnees[1];

    $facture = req_facture($bdd,$id_commande);
    
    $sortie = table_detail_panier($bdd,$produits);
    $poids_total = $sortie['3'];
    $client = $sortie[0];
    $table = $sortie[1];
    $prix_tot = $sortie[2];
    $remise = $prix_tot*5/100;
    $tva = ($prix_tot-$remise)*20/100;
    $livraison = 2+ 0.001*$poids_total;
    $adresse_livraison = req_livraison($bdd,$id_commande);
}
else {
    $titre = '';
    $client = [];
    $table = '';
    $prix_tot = 0;
}
?>