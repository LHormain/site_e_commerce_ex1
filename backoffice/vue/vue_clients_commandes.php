<?php
include ('controler/traitement_clients_commandes.php');
?>
<div class="col-10 p-5 text-center">
    <h2>Gestion des commandes clients</h2>

    <div class="table-responsive">
        <table class="table table-striped
        table-hover	
        table-bordered
        align-middle">
            <thead class="table-primary">
                <!-- <caption>Table Name</caption> -->
                <tr>
                    <th><a href="index.php?page=10&ordre=1">Client</a></th>
                    <th><a href="index.php?page=10&ordre=2">N° de commande</a></th>
                    <th><a href="index.php?page=10&ordre=3">Date</a></th>
                    <th>Nombre de produits</th>
                    <th>Récapitulatif</th>
                    <th>Montant TTC</th>
                    <th><a href="index.php?page=10&ordre=4">État du payement</a></th>
                    <th><a href="index.php?page=10&ordre=5">Statut livraison</a></th>
                </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php
                        echo $table;
                    ?>

                </tbody>
                <tfoot>
                    
                </tfoot>
        </table>
    </div>
    
</div>

<script src="public/assets/js/select_livraison.js"></script>