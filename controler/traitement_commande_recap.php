<?php
if (isset($_GET['id'],
        $_GET['fac']) 
&& $_GET['id'] != NULL
&& $_GET['fac'] != NULL
) {
    $id_commande = intval($_GET['id']);
    $fac = intval($_GET['fac']);

    if ($fac == 1) {
        $titre = 'Facture';
    }
    else {
        $titre = 'Récapitulatif de la commande';
    }

    // récupère les produits
    $produits = req_produits_commande($bdd,$id_commande);

    $table = '';
    $prix_tot = 0;
    $prix_payer = $produits[0]['montant_commande'];
    $id_client = $produits[0]['id_client'];

    foreach ($produits as $ligne) {
        $prix = $ligne['quantite_produit']*$ligne['prix_unitaire_produit'];
        $prix_tot += $prix;
        $table .= '
        <tr class="table-light" >
            <td scope="row">'.$ligne['quantite_produit'].'</td>
            <td>'.$ligne['nom_produit'].'</td>
            <td>'.$ligne['prix_unitaire_produit'].'</td>
            <td>'.$prix.'</td>
        </tr>
        ';
    }
    // remise promotionnelle de 5%
    $taux_remise = 5;
    $prix_tot_rem = $prix_tot*(1-$taux_remise/100);
    //tva à 20%
    $taux_tva = 20;
    $prix_tot_ttc = $prix_tot_rem*(1+$taux_tva/100);
    //frai de port
    $livraison = $prix_payer-$prix_tot_ttc;
    
    // récupère le client et ses adresses
    $client = req_client_adresse2($bdd, $id_client);

    $adresse_l = '';
    $adresse_f = '';
    foreach ($client as $ligne) {
        if ($ligne['livraison_client'] == 1) {
            if ($produits[0]['id_adresse'] == $ligne['id_adresse']) {
                $adresse_l = $ligne['rue_client'].'<br> '.$ligne['code_p_client'].' '.$ligne['ville_client'].'<br>'.$ligne['pays_client'];
            }
        }
        else {
            $adresse_f = $ligne['rue_client'].'<br> '.$ligne['code_p_client'].' '.$ligne['ville_client'].'<br>'.$ligne['pays_client'];
        }
    }

}

?>
