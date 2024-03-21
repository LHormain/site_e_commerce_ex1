<?php
if (isset($_GET['id']) && $_GET['id'] != NULL) {

    $id_contact = htmlspecialchars($_GET['id']);

    $donnees = req_message($bdd,$id_contact);

}

?>