<?php
if (isset($_GET['c']) && $_GET['c'] != NULL) {
    $c = intval(htmlspecialchars($_GET['c']));
    if ($c == 1) {
        include('vue/vue_ateliers_saisie.php');
    }
    elseif ($c == 2) {
        include('vue/vue_ateliers_gestion.php');
    }
    elseif ($c == 3) {
        include('vue/vue_ateliers_inscription.php');
    }
    elseif ($c == 31) {
        include('vue/vue_ateliers_gestion_inscription.php');
    }
    elseif ($c == 4) {
        include('vue/vue_ateliers_saisie_horaire.php');
    }
    elseif ($c == 41) {
        include('vue/vue_ateliers_gestion_horaire.php');
    }
    elseif ($c == 5) {
        include('vue/vue_ateliers_saisie_paragraphe.php');
    }
    elseif ($c == 51) {
        include('vue/vue_ateliers_gestion_paragraphe.php');
    }
    elseif ($c == 6) {
        include('vue/vue_ateliers_saisie_image.php');
    }
    elseif ($c == 61) {
        include('vue/vue_ateliers_gestion_image.php');
    }
    else {
        include('vue/vue_ateliers_inscription.php');
    }
}
else {
    include('vue/vue_ateliers_inscription.php');
}
?>