<?php
include('controler/traitement_commande_clients.php');
?>

<div class="container">
    <div class="row align-items-start">
        <div class="table-responsive col mb-5">
            <h1>Récapitulatif de ma commande :</h1>
            <table class="table table-hover	">
                <tbody class="table-group-divider">
                    <tr class="" >
                        <td scope="row">Client :</td>
                        <td><?php echo $client['prenom_client'].' '.$client['nom_client']; ?></td>
                    </tr>
                    <tr class="">
                        <td scope="row">Commande numéro :</td>
                        <td><?php echo $id_commande; ?></td>
                    </tr>
                    <tr class="">
                        <td scope="row">Date :</td>
                        <td><?php echo $date; ?></td>
                    </tr>
                    <tr class="">
                        <td scope="row">Total à payer:</td>
                        <td><?php echo number_format($prix_livraison,2,',',' '); ?> €</td>
                    </tr>
                    <tr class="">
                        <td scope="row">Adresse de livraison :</td>
                        <td>
                            <div class="mb-3">
                                <select class="form-select form-select-lg" name="<?php echo $id_commande; ?>" id="livraison_source">
                                    </div>
                                    <?php 
                                        echo $select_livraison;
                                        ?>
                                </select>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
        <div class="col-lg-3 offset-1 mb-5 border">
            <h2 class="text-center mt-5">Ma commande</h2>
            <div class="row mt-5 fw-bold">
                <div class="col-7 offset-1">Total article HT </div>
                <div class="col-3 text-end" id="prix_total"><?php  echo number_format($prix_total,2,',',' '); ?> €</div>
            </div>
            <div class="row fw-bold">
                <div class="col-7 offset-1">Remise 5% </div>
                <div class="col-3 text-end" id="prix_total">-<?php  echo number_format($prix_total-$prix_tot_rem,2,',',' '); ?> €</div>
            </div>
            <div class="row fw-bold">
                <div class="col-7 offset-1">TVA </div>
                <div class="col-3 text-end" id="prix_total">+<?php  echo number_format($prix_tot_ttc-$prix_tot_rem,2,',',' '); ?> €</div>
            </div>
            <div class="row mb-3 fw-bold">
                <div class="col-7 offset-1">Frai de livraison </div>
                <div class="col-3 text-end" id="prix_total"><?php  echo number_format($frai_port,2,',',' '); ?> €</div>
            </div>
            <div class="row mb-5 fw-bold">
                <div class="col-7 offset-1">Prix total TTC </div>
                <div class="col-3 text-end" id="prix_total"><?php  echo number_format($prix_livraison,2,',',' '); ?> €</div>
            </div>
            <div class="text-center mb-5">
                <form action="../test/banque_test.php" method="post">
                    <input type="hidden" name="id_commande" value ="<?php echo $id_commande; ?>">
                    <input type="hidden" name="token" value ="<?php echo $token; ?>">
                    <input type="hidden" name="mail_client" value ="<?php echo $client['mail_client']; ?>">
                    <input type="hidden" name="prix_livraison" value ="<?php echo $prix_livraison; ?>">
                    <!-- <input type="hidden" name="livraison" id="livraison" value ="<?php echo $livraison; ?>"> -->
                    <input type="submit" value="Passer commande" class="btn btn-primary" id="payer" <?php if ($test == 0){echo 'disabled';}?>>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="public/assets/js/select_livraison.js"></script>