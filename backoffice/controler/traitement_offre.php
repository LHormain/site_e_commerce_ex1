<?php
if (isset($_GET['c']) && $_GET['c'] != NULL) {
    $c = intval(htmlspecialchars($_GET['c']));
    if ($c == 1) {
        include('vue/vue_offre_saisie.php');
    }
    elseif ($c == 2) {
        include('vue/vue_offre_gestion.php');
    }
    elseif ($c == 3) {
        include('vue/vue_offre_saisie_img.php');
    }
    else {
        include('vue/vue_offre_saisie.php');
    }
}
else {
    include('vue/vue_offre_saisie.php');
}
?>