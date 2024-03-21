<?php
if (isset($_GET['id']) && $_GET['id'] != NULL) {
    $id_commande = intval($_GET['id']);

    $id_client = intval($_SESSION['id_client']);
    $jour = time();
    $date = date('d-m-Y', $jour);

    $donnees = req_select_panier2($bdd,$id_commande);

    $prix_total = 0.0;
    $poids_total = 0;
    if ($donnees != '') {
        foreach ($donnees as $produit) {
            $prix = $produit['quantite_produit']*$produit['prix_unitaire_produit'];
            $prix_total = $prix_total + $prix;
            $poids_total += $produit['quantite_produit']*$produit['poids_produit'];
        }
        // si reduction sur prix les calculer ici (-5% offre promo, TVA, ...)
        // si ajout frais de port ajouter ici 
    }
    // remise promotionnelle de 5%
    $taux_remise = 5;
    $prix_tot_rem = $prix_total*(1-$taux_remise/100);
    //tva à 20%
    $taux_tva = 20;
    $prix_tot_ttc = $prix_tot_rem*(1+$taux_tva/100);
    //frai de port
    $frai_port = 2 + 0.001*$poids_total;
    $prix_livraison = $prix_tot_ttc + $frai_port;


    $client = req_clients_identifiant($bdd, $id_client);
    $adresses = req_adresses($bdd,$client['id_client'],1);
    $livraison = $adresses[0]['id_adresse'];
    $select_livraison = '';
    foreach ($adresses as $adresse) {
        $select_livraison .= '
        <option value="'.$adresse['id_adresse'].'">
            '.$adresse['rue_client'].' '.$adresse['code_p_client'].' '.$adresse['ville_client'].' '.$adresse['pays_client'].'
        </option>'; 
    }

    // création d'un identifiant à 6 characters. 
    
    do {
        $token = bin2hex(random_bytes(3));
        // test si token unique
        $test = req_token_unique($bdd,$token);

    } while ($test != 0);

    // enregistre le token et la commande et le compte associé
    req_save_token($bdd,$id_commande,$jour,$token,$client['id_client'],$prix_livraison,$livraison);
    
    // enregistrement de la commande
    req_panier_a_commande($bdd,$id_commande);
    
    // test si il y a des produits dans la commande
    $test = req_test_commande2($bdd, $id_commande);
}


?>