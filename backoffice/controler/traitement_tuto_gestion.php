<?php
//delete
if (isset($_GET['sup']) && $_GET['sup'] != NULL) {
    $id_tutoriel = intval($_GET['sup']);

    req_sup_tuto($bdd,$id_tuto);
}

//select
$donnees =req_All_tuto($bdd);

$table = table_tuto($donnees);

?>