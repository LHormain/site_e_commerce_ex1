<?php
if (isset($_GET['c']) && $_GET['c'] != NULL) {
    $c = intval(htmlspecialchars($_GET['c']));
    if ($c == 1) {
        include('vue/vue_images_produits_saisie.php');
    }
    elseif ($c == 2) {
        include('vue/vue_images_produits_gestion.php');
    }
    else {
        include('vue/vue_images_produits_gestion.php');
    }
}
else {
    include('vue/vue_images_produits_gestion.php');
}
?>