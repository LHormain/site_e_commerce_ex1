<?php
include('controler/traitement_clients_paniers.php');
?>

<div class="col-10 p-5 text-center">
    <h2>Gestion des paniers <?php echo $texte; ?></h2>

    

    <div class="table-responsive">
        <table class="table table-striped
        table-hover	
        table-bordered
        align-middle">
            <thead class="table-primary">
                <!-- <caption>Table Name</caption> -->
                <tr>
                    <th>n° panier</th>
                    <th><a href="index.php?page=9&ordre=1">Date</a></th>
                    <th>Nombre de produits</th>
                    <th>Montant TTC</th>
                    <th><a href="index.php?page=9&ordre=2">Client</a></th>
                    <th>Récapitulatif</th>
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