<?php

if (isset($_GET['c']) && $_GET['c'] != NULL) {
    $c = intval(htmlspecialchars($_GET['c']));
    if ($c == 1) {
        include('vue/vue_produit_saisie.php');
    }
    elseif ($c == 2) {
        include('vue/vue_produit_gestion.php');
    }
    elseif ($c == 3) {
        include('vue/vue_produit_cat.php');
    }
    else {
        include('vue/vue_produit_saisie.php');
    }
}
else {
    include('vue/vue_produit_saisie.php');
}
?>