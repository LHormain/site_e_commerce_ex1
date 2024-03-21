//------------------------------------------------------------------
//     génère les sous cat en fonction de la cat sélectionnée
//------------------------------------------------------------------

function chargementSelect(livraison,commande) {
    
    // création de l'objet XHLHttpRequest
    const xmlhttp = new XMLHttpRequest(); 
    
    xmlhttp.open("POST", "controler/requete_adresse_livraison.php", true); // il va chercher le fichier et l'ouvre
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); // obligatoire pour post
    xmlhttp.onload = function() { // peut aussi utiliser onreadystatechange ou autre chose
        
    }
    
    data = ('id_adresse='+ livraison +'&id_commande='+commande);
    xmlhttp.send(data);

}

let adresses = document.getElementById('livraison_source');
adresses.addEventListener('change', function() {
    let livraison = adresses.options[adresses.selectedIndex].value;
    let commande = adresses.name;
    chargementSelect(livraison,commande);
});