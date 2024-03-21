<?php
// delete
if (isset($_GET['sup']) && $_GET['sup'] != NULL) {
    $id_contact = intval($_GET['sup']);

    req_delete_contact($bdd,$id_contact);
}

//classement
if (isset($_GET['ordre']) && $_GET['ordre'] != NULL) {
    $ordre = intval($_GET['ordre']);

    if ($ordre == 1) {
        $ordre_req = 'ORDER BY date_message';
    }
    elseif ($ordre == 2) {
        $ordre_req = 'ORDER BY nom_contact';
    }
    else {
        $ordre_req = 'ORDER BY id_contact';
    }
}
else {
    $ordre_req = '';
}

// affichage
$contacts = req_contacts($bdd,$ordre_req);

$table_messages = '';
foreach ($contacts as $donnees) {
    $table_messages .= table_contact_gestion($donnees);
}
?>