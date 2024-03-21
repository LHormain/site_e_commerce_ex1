<?php
if (isset($_POST['id_atelier']) && $_POST['id_atelier'] != NULL) {
    $id_atelier = intval($_POST['id_atelier']);

    $donnees = req_ateliers($bdd,$id_atelier);

    // tableau avec toutes les inscriptions
    $inscriptions =req_inscriptions($bdd,$id_atelier);

    $table = table_ateliers_gestion_inscriptions($inscriptions);

    // récapitulatif inscriptions
    $horaires = req_stat_inscriptions($bdd,$id_atelier);

    $recapitulatif = '';
    foreach ($horaires as $lignes) {
        $recapitulatif .= '
        <p>'.date('d-m-Y à H:i', $lignes['date_atelier']).' : '.$lignes['nbr_participant'].' participants, reste '.($lignes['nombre_participant_max']-$lignes['nbr_participant']).' places.</p>
        ';
    }

}
?>