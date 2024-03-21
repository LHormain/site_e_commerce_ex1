// fonction favoris
function annulerAtelier(heure, client, atelier) {
    const xmlhttp = new XMLHttpRequest();
    
    xmlhttp.open("POST", "controler/requete_annuler_atelier.php", true); // il va chercher le fichier et l'ouvre
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); // obligatoire pour post
    xmlhttp.onload = function() { // peut aussi utiliser onreadystatechange ou autre chose
        const myobj = this.responseText;
        let resultat = document.getElementById(heure);

        if (myobj == 'annule') {
            resultat.innerHTML = 'Annulation en cours de traitement';
            resultat.setAttribute('disabled','');
        }
        else {
            resultat.innerHTML = 'Demande d\'annulation';
        }
    }
    
    data = ('id_client='+ client +'&id_atelier='+ atelier+'&id_horaire='+heure);
    xmlhttp.send(data);

}

// addEventListener
let allProduits = document.querySelectorAll('.annuler');
allProduits.forEach(produit => {
    let heure = produit.id;
    let client = produit.name;
    let atelier = produit.value;
    produit.addEventListener('click', function() {
        annulerAtelier(heure, client, atelier);
    });
});