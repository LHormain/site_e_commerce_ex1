<?php
include('controler/traitement_client_panier_details.php');
?>
<div class="col-md-10 p-5 ">
    <h2 class="text-center"><?php echo $titre; ?></h2>
    <h3 class="text-start">
        client : <?php echo $client['prenom_client'].' '.$client['nom_client']; ?>
    </h3>
    <div class="row">
        <div class="col-2 col-md-1">
            Adresse de livraison : 
        </div>
        <div class="col-md-2 col-3">
            <?php 
                if (isset($_GET['fac']) || isset($_GET['com'])) { 
                    echo '<p>'.$adresse_livraison['rue_client'].'<br>'.$adresse_livraison['code_p_client'].' '.$adresse_livraison['ville_client'].'<br>'.$adresse_livraison['pays_client'].'</p>';
                }
                else {
                    echo '<p><br><br></p>';
                }
                 ?>
        </div>

        <div class="col-md-1 col-2">
            <div>
                Téléphone : 
            </div>
            <div>
                Mail :
            </div>

        </div>
        <div class="col-md-2 col-3">
            <div>
                <?php  echo $client['tel_client']; ?>
            </div>
            <div>
                <?php echo $client['mail_client']; ?>
            </div>

        </div>
        <div class=" col-10 text-end mb-5">
            <div>
                <?php if ($fac == 1) {echo 'Facture n° : '.$facture['id_facture'];} ?>
            </div>
            <div>
                <?php if (isset($_GET['pan'])) {
                    echo 'Date : '.date('d-m-Y à H:i', $id_panier);
                } 
                else {
                    echo 'Date : '.date('d-m-Y à H:i', $date['date_commande']); 
                }
                ?>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped
        table-hover	
        table-bordered
        table-primary
        ">
            <thead class="table-light">
                <caption class="no-print">Liste des produits</caption>
                <tr>
                    <th>Nom du produit</th>
                    <th>Quantité produit</th>
                    <th>Prix unitaire produit (€)</th>
                    <th>Montant (€)</th>
                </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php
                        echo $table;
                    ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="text-end">Sous total HT (€): </td>
                        <td><?php echo $prix_tot; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="text-end">Remise 5% (€): </td>
                        <td>-<?php echo $remise; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="text-end">TVA (€): </td>
                        <td>+<?php echo $tva; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="text-end">Livraison (€): </td>
                        <td>+<?php echo $livraison; ?></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="text-end">Total TTC (€): </td>
                        <td><?php echo $prix_tot - $remise + $tva + $livraison; ?></td>
                    </tr>
                </tbody>
                <tfoot>
                    
                </tfoot>
        </table>
    </div>
    <div class="text-end no-print">
        <button type="button" class="btn btn-primary " id="imprimer">Imprimer</button>
    </div>
</div>

<script src="public/assets/js/print.js"></script>