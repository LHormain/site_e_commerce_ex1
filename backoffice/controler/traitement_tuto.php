<?php
if (isset($_GET['c']) && $_GET['c'] != NULL) {
    $c = intval(htmlspecialchars($_GET['c']));
    if ($c == 1) {
        include('vue/vue_tuto_saisie.php');
    }
    elseif ($c == 2) {
        include('vue/vue_tuto_gestion.php');
    }
    elseif ($c == 4) {
        include('vue/vue_tuto_saisie_materiaux.php');
    }
    elseif ($c == 3) {
        include('vue/vue_tuto_gestion_portfolio.php');
    }
    else {
        include('vue/vue_tuto_saisie.php');
    }
}
else {
    include('vue/vue_tuto_saisie.php');
}
?>