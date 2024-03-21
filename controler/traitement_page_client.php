<?php
//---------------------------------------------
//            suppression d'un panier
//---------------------------------------------
if (isset($_GET['sup']) && $_GET['sup'] != NULL) {
    $id_commande = intval($_GET['sup']);

    req_sup_panier($bdd, $id_commande);
}

//-------------------------------------------
//              données clients
//-------------------------------------------

$donnees = req_id_client($bdd);

$livraison = req_adresses($bdd,$donnees['id_client'],1);

$facturation = req_adresses($bdd,$donnees['id_client'],2);

$adresse_livraison = '';
$i=1;
foreach ($livraison as $adresse) {
    $adresse_livraison .= '
    <div class="col-md-1 col-lg-1 mb-3 text-center"> 
        '.$i.'
    </div>
    <div class="col-md-3 col-lg-3 mb-3 text-center"> 
        '.$adresse['rue_client'].'  <br>
        '.$adresse['code_p_client'].' '.$adresse['ville_client'].' <br>
        '.$adresse['pays_client'].' 
    </div>
    <div class="col-md-8 col-lg-8 mb-3">
        <a href="index.php?page=61&c='.$donnees['id_client'].'&ad='.$adresse['id_adresse'].' ?>" class="btn btn-primary">Modifier mon adresse de livraison</a>
    </div>
    ';
    $i++;
}

$adresse_facturation = '';
foreach ($facturation as $adresse) {
    $adresse_facturation .= '
    <div class="col-md-1 col-lg-1 mb-3 text-center"> 
    </div>
    <div class="col-md-3 col-lg-3 mb-3 text-center"> 
        '.$adresse['rue_client'].'  <br>
        '.$adresse['code_p_client'].' '.$adresse['ville_client'].' <br>
        '.$adresse['pays_client'].' 
    </div>
    <div class="col-md-6 col-lg-4 mb-3">
        <a href="index.php?page=61&c='.$donnees['id_client'].'&cad='.$adresse['id_adresse'].' ?>" class="btn btn-primary">Modifier mon adresse de livraison</a>
    </div>
    ';
}

//--------------------------------------------
//           récupère ses paniers
//--------------------------------------------
// toutes les id_commande associé à ce client
$commandes = req_commandes($bdd,$donnees['id_client']);

$table = gestion_paniers($bdd,$commandes);

$commandes_payer = req_commande_payer($bdd,$donnees['id_client']);

$table3 = gestion_commandes($bdd,$commandes_payer);
//--------------------------------------------
//récupère les inscriptions aux ateliers
//--------------------------------------------
$ateliers = req_gestion_ateliers($bdd,$donnees['id_client']);

$table2 = gestion_ateliers($ateliers);
?>