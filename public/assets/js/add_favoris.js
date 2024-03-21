// fonction favoris
function addFavoris(id_produit, identifiant_client) {
    const xmlhttp = new XMLHttpRequest();
    
    xmlhttp.open("POST", "controler/requete_add_favoris.php", true); // il va chercher le fichier et l'ouvre
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); // obligatoire pour post
    xmlhttp.onload = function() { // peut aussi utiliser onreadystatechange ou autre chose
        const myobj = this.responseText;
        let resultat = document.getElementById(id_produit);

        if (myobj == 'add') {
            resultat.innerHTML = '<img src="public/assets/img/icones/coeur1.png" alt="" class=" img-fluid icones btn_jaime">';
        }
        else {
            resultat.innerHTML = '<img src="public/assets/img/icones/coeur2.png" alt="" class=" img-fluid icones btn_jaime">';
        }
    }
    
    data = ('identifiant_client='+ identifiant_client +'&id_produit='+ id_produit);
    xmlhttp.send(data);

}

// addEventListener
let allProduits = document.querySelectorAll('.card_produit');
allProduits.forEach(produit => {
    let id = produit.id;
    let client = produit.value;
    produit.addEventListener('click', function() {
        addFavoris(id,client);
    });
});