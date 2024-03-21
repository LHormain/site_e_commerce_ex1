<?php
$message_page_courante = '';
//--------------------------------------------------------
//                        inscription
//--------------------------------------------------------
if (isset($_POST['id_client'],
$_POST['id_atelier'],
$_POST['id_horaire'],
$_POST['nbr_inscrit']
)
&& $_POST['id_client'] != NULL
&& $_POST['id_atelier'] != NULL
&& $_POST['id_horaire'] != NULL
&& $_POST['nbr_inscrit'] != NULL
) {
    $id_client = intval($_POST['id_client']);
    $id_atelier = intval($_POST['id_atelier']);
    $id_horaire = intval($_POST['id_horaire']);
    $nbr_inscrit = intval($_POST['nbr_inscrit']);
 
    $nbr = req_inscription_atelier($bdd,$id_client,$id_atelier,$id_horaire,$nbr_inscrit);

    $message_page_courante = '<h2>Votre inscription a été réalisé avec sucé. Rendez-vous le '.date('d-m-Y à h:i',$nbr).'. Nous vous attendons avec impatience.</h2>';
}

//---------------------------------------------------------
//              récupération du numéro d'atelier 
//---------------------------------------------------------
// récupération du client
$client = req_id_client($bdd);

if (isset($_GET['c']) && $_GET['c'] != NULL) {
    $c = intval($_GET['c']);

    $donnees = req_formulaire_atelier($bdd,$c,);
    $atelier = $donnees[0];
    $horaire = $donnees[1];

    $liste = req_ateliers_client($bdd,$client['id_client'],$atelier['id_atelier']);

    $radio_horaire = '';

    foreach ($horaire as $date) {
        $nbr_places = $atelier['nombre_participant_max'] - $date['nbr_participant'];
        if ($nbr_places == 0) {
            $etat = 'disabled';
            $message='Plus de places disponible';
        }
        elseif(in_array($date['id_horaire'],$liste)) {
            $etat = 'disabled';
            $message = 'Vous êtes déjà inscrit.';
        }
        else {
            $etat = '';
            $message = '';
        }

        $radio_horaire .= '
        <div class="form-check form-check-inline ">
            <input class="form-check-input" type="radio" name="id_horaire" id="'.$date['id_horaire'].'" value="'.$date['id_horaire'].'"'.$etat.'>
            <label class="form-check-label" for="'.$date['id_horaire'].'">'.date('d-m-Y à H:i',$date['date_atelier']).' reste : '.$nbr_places.' places. '.$message.'</label>
        </div>
        ';
    }
}


?>