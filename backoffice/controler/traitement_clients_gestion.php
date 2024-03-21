<?php
// récupération ordre classement
if (isset($_GET['ordre']) && $_GET['ordre'] != NULL) {
    $ordre = intval($_GET['ordre']);
    
    if ($ordre == 1) {
        $ordre_req = 'ORDER BY identifiant_client';
    }
    elseif ($ordre == 2) {
        $ordre_req = 'ORDER BY nom_client';
    }
    elseif ($ordre == 3) {
        $ordre_req = 'ORDER BY prenom_client';
    }
    else {
        $ordre_req = 'ORDER BY id_client';
    }
}
else {
    $ordre_req = 'ORDER BY id_client';
}

//affichage
$clients = req_clients($bdd,$ordre_req);

$table_clients = '';
foreach ($clients as $donnees) {
    // adresse livraison
    $donnees2 = req_adresse_livraison($bdd,$donnees['id_client']);
    
    // adresse facturation
    $donnees3 = req_adresse_facturation($bdd,$donnees['id_client']);
    
    $table_clients .= table_clients_gestion($donnees, $donnees2, $donnees3);
}

?>