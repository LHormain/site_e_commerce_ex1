<?php
$texte = '';
// purge paniers sans client de plus de 48 heures
req_purge_panier_sans_client($bdd);

// ///---------------------------------------------------------------------------------
// // envoyer un mail de relance aux clients qui ont un paniers de plus de 48 heures
// ///---------------------------------------------------------------------------------
// $clients = req_relance($bdd);
// include('../modele/data.php');
// //----------
// //// provisoire en attendant d'envoyer mail: écrit dans un fichier
// $file = '../../test/test_mail_relance.html';
// // $current = file_get_contents($file);
// $current = '';
// //----------

// foreach ($clients as $client) {
//     $donnees = req_panier_nom($bdd,$client);
//     $mail = $donnees['mail_client'];
//     $sujet = "Votre panier se sent seul!";
//     $message = '
//     <table>
//         <tr><td>
//         Avez vous rencontré un problème lors de vos achats?<br><br>
//         </td></tr>
//         <tr><td style="border-bottom : 1px solid black">
//         Si vous avez besoin d\'assistance n\'hésitez pas à nous poser vos questions en contactant notre service client au '.$tel_site.' ou par mail :'.$mail_site.'
//         </td></tr>

//     </table>
//     ';
//     $headers = "From : ".$mail_site."\r\n";
//     $headers .= "X-Mailer: PHP/".phpversion()."\r\n" ;
//     $headers .= "MIME-Version: 1.0\r\n";
//     $headers .= "Content-type: text/html; charset=UTF-8\r\n";
//     $headers .= "Content-Transfer-Encoding: 8bit\r\n\r\n";

//     // mail basique à remplacer par l'appelle d'un service qui gère l'envoie d'un grand nombre de mail
//     // mail($mail, $sujet, $message, $headers);

//     //----------
//     $current .= '<table><tr><td>'.$headers.'</td></tr></table>';
//     $current .= '<table><tr><td>'.$sujet.'</td></tr></table>';
//     $current .= $message;
//     //----------
// }

// //----------
// file_put_contents($file, $current);
// //// fin provisoire
// //----------
// ///---------------------------------------------------------------------------------

//----------------------------------------------------------------------
//                            Affichage
//----------------------------------------------------------------------
// classement
if (isset($_GET['ordre']) && $_GET['ordre'] != NULL) {
    $ordre = intval($_GET['ordre']);
    
    if ($ordre == 1) {
        $ordre_req = 'ORDER BY id_commande';
    }
    elseif ($ordre == 2) {
        $ordre_req = 'ORDER BY id_client';
    }
    else {
        $ordre_req = '';
    }
}
else {
    $ordre_req = '';
}

if (isset($_GET['id']) && $_GET['id'] != NULL) {
    // seulement les paniers d'un clients précis
    $id_client = htmlspecialchars($_GET['id']);

    $where_req = 'WHERE id_client = :id_client';

    $texte = ' du client n°'.$id_client;
}
else {
    // tous les paniers existants
    $where_req = '';
    $id_client = 0;

    $texte = 'clients';
}

$commandes = req_commandes($bdd,$where_req,$ordre_req,$id_client);

// écriture de la table
$table = table_panier_gestion($bdd,$commandes);

?>