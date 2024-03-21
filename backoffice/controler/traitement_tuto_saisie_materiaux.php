<?php
//--------------------------------------------------------
//       récupération des données du formulaire
//--------------------------------------------------------
if (isset($_GET['mat']) && $_GET['mat'] != NULL) {
    $id_materiel = intval($_GET['mat']);
    $btn_submit = 'Modifier';

    $donnees = req_materiel($bdd,$id_materiel);
    $intitule_materiel = $donnees['intitule_materiel'];
    $description_materiel = $donnees['description_materiel'];
}
else {
    $id_materiel = 0;
    $btn_submit = 'Ajouter';

    $intitule_materiel = '';
    $description_materiel = '';
}

if (isset($_POST['intitule_materiel'],
$_POST['description_materiel']
)
&& $_POST['intitule_materiel'] != NULL
&& $_POST['description_materiel'] != NULL
) {
    $intitule_materiel = htmlspecialchars($_POST['intitule_materiel']);
    $description_materiel = htmlspecialchars($_POST['description_materiel']);
    $id_tutoriel = intval($_GET['id']);

    if (isset($_GET['mat']) && $_GET['mat'] != NULL) {
        // update
        $id_materiel = intval($_GET['mat']);

        req_update_materiel($bdd,$intitule_materiel,$description_materiel,$id_materiel);
    }
    else {
        //insert
        req_insert_materiel($bdd,$intitule_materiel,$description_materiel,$id_tutoriel);

    }

}

//---------------------------------------------------------
//                 suppression d'un matériel
//---------------------------------------------------------
if (isset($_GET['sup']) && $_GET['sup'] != NULL) {
    $id_materiel = intval($_GET['sup']);

    req_sup_materiel($bdd,$id_materiel);
}

//---------------------------------------------------------
//                   affichage de la page
//---------------------------------------------------------
if (isset($_GET['id']) && $_GET['id'] != NULL) {
    $id_tutoriel = intval($_GET['id']);

    $tutoriel = req_tuto($bdd,$id_tutoriel);

    $liste_materiaux = req_all_materiel($bdd,$id_tutoriel);

    $table = table_materiel($liste_materiaux,$id_tutoriel);
}

?>