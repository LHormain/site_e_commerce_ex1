<?php
include('controler/traitement_commande_recap.php');
?>

<div class="container">
    <div class="row">
        <div class=" col-md-9 mt-5 no-print">
            <h1>Étoffe en ligne</h1>
            <ul class="p-0">
                <li>456 Avenue des Tissus, Centre Commercial Couture</li>
                <li>75002 Modeville</li>
                <li>Créativeland</li>
                <li><a href=""><i class="fa-solid fa-at"></i> : info@etoffeenligne.com</a></li>
                <li><i class="fa-solid fa-phone"></i> : 01 23 45 67 89</li>
            </ul>
        </div>
        <div class="col-md-3 mt-5 d-none d-md-block  no-print">
            <img src="public/assets/img/logo/logo_v5.png" alt="" class="img-fluid logo_header">
        </div>
        <div class="  col-md-9 mt-5  no-print">
            <p>Client : <?php echo $client[0]['prenom_client'] ?> <?php echo $client[0]['nom_client'] ?></p>
            <div class="row">

                <p class="col-md-2">Adresse de livraison : </p><p class="col-md-10"><?php echo $adresse_l; ?></p>
                <p class="col-md-2">Adresse de facturation : </p><p class="col-md-10"><?php echo $adresse_f; ?></p>
            </div>
        </div>
        <div class="col-md-3  no-print">
            <p>Date : <?php echo date('d/m/Y', $produits[0]['date_commande']); ?></p>
            <p>Commande n° <?php echo $produits[0]['id_commande']; ?></p>
            <p><?php if ($fac == 1) { echo 'Facture n° :';} ?></p>
            <p></p>
        </div>
        <div class="imprimer row">
            <div class="col-9 mt-5">
                <h1>Étoffe en ligne</h1>
                <ul class="p-0">
                    <li>456 Avenue des Tissus, Centre Commercial Couture</li>
                    <li>75002 Modeville</li>
                    <li>Créativeland</li>
                    <li><a href=""><i class="fa-solid fa-at"></i> : info@etoffeenligne.com</a></li>
                    <li><i class="fa-solid fa-phone"></i> : 01 23 45 67 89</li>
                </ul>
            </div>
            <div class="col-3 mt-5 ">
                <img src="public/assets/img/logo/logo_v5.png" alt="" class="img-fluid logo_header">
            </div>
            <div class="col-9 mt-5">
                <p>Client : <?php echo $client[0]['prenom_client'] ?> <?php echo $client[0]['nom_client'] ?></p>
                <div class="row">

                    <p class="col-4">Adresse de livraison : </p><p class="col-6"><?php echo $adresse_l; ?></p>
                    <p class="col-4">Adresse de facturation : </p><p class="col-6"><?php echo $adresse_f; ?></p>
                </div>
            </div>
            <div class="col-3">
                <p>Date : <?php echo date('d/m/Y', $produits[0]['date_commande']); ?></p>
                <p>Commande n° <?php echo $produits[0]['id_commande']; ?></p>
                <p><?php if ($fac == 1) { echo 'Facture n° :';} ?></p>
                <p></p>
            </div>
        </div>
        <h2 class="text-center mb-3 mt-5"><?php echo $titre; ?></h2>
        <div class="table-responsive  my-5">
            <table class="table table-striped
            table-hover	
            table-borderless
            align-middle">
                <thead class="">
                    <tr>
                        <th>Quantité</th>
                        <th>Désignation produit</th>
                        <th>Prix unitaire</th>
                        <th>Montant (€)</th>
                    </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        <?php
                            echo $table;
                        ?>
                    </tbody>
                    <tfoot class="">
                        <tr class="">
                            <td scope="row"></td>
                            <td></td>
                            <td>Sous total (€)</td>
                            <td><?php echo $prix_tot; ?></td>
                        </tr>
                        <tr class="">
                            <td scope="row"></td>
                            <td></td>
                            <td>Remise promotionnelle 5% (€)</td>
                            <td><?php echo $prix_tot_rem-$prix_tot; ?></td>
                        </tr>
                        <tr class="">
                            <td scope="row"></td>
                            <td></td>
                            <td>TVA (€)</td>
                            <td><?php echo $prix_tot_ttc-$prix_tot_rem; ?></td>
                        </tr>
                        <tr class="">
                            <td scope="row"></td>
                            <td></td>
                            <td>Frai de livraison (€)</td>
                            <td><?php echo $livraison; ?></td>
                        </tr>
                        <tr class="">
                            <td scope="row"></td>
                            <td></td>
                            <td>Total (€)</td>
                            <td><?php echo $prix_payer; ?></td>
                        </tr>
                    </tfoot>
            </table>
            <div class="text-end no-print">
                <button type="button" class="btn btn-primary " id="imprimer">Imprimer</button>
            </div>
        </div>
    </div>
</div>

<script src="public/assets/js/print.js"></script>