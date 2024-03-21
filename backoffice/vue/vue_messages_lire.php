<?php
include('controler/traitement_contact_lire.php');
?>
<h3 class="mt-3">Message n° <?php echo $id_contact; ?></h3>

<div>
    <p><strong>Expediteur : </strong><?php echo $donnees['nom_contact']; ?></p>
    <p><strong>Sujet : </strong><?php echo $donnees['categorie_contact']; ?></p>
    <p><?php echo nl2br($donnees['message_contact']); ?></p>
</div>
<div>
    <a  class="btn btn-primary" href="index.php?page=8&c=2" role="button">Retour à la page gestion</a>
    <a  class="btn btn-primary" href="mailto:<?php echo $donnees['mail_contact']; ?>" role="button" onclick="gestionAfficher(<?php echo $donnees['id_contact']; ?>,<?php echo $donnees['repondu_message']; ?>)">Répondre</a>
</div>

<script src="public/assets/js/gestion_repondu.js"></script>