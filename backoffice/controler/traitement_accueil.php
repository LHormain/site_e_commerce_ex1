<?php
// récupération du nombre de massage non lue
$donnees = req_aff_nbr_messages($bdd);

$nbr_messages = $donnees['nbr_messages'];

?>