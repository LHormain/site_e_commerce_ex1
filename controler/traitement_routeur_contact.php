<?php  
// routeur interne
if (isset($_GET['r']) && $_GET['r'] != NULL) {
    $c = intval(htmlspecialchars($_GET['r']));
    if ($c == 1) {
        include('vue/vue_contact_form.php');
    }
    elseif ($c == 2) {
        include('vue/vue_contact_traitement.php');
    }
    else {
        include('vue/vue_contact_form.php');
    }
}
else {
    include('vue/vue_contact_form.php');
}
// fin routeur interne

?>