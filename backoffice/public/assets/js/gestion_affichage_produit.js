//----------------------------------------------------------
//    gestion affichage ou non d'un produit
//----------------------------------------------------------

function gestionAfficher(id_produit, afficher_produit) {
    // création de l'objet XHLHttpRequest
    const xmlhttp = new XMLHttpRequest(); 
    
    xmlhttp.open("POST", "controler/requete_gestion_affichage_produit.php", true); // il va chercher le fichier et l'ouvre
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); // obligatoire pour post
    xmlhttp.onload = function() { // peut aussi utiliser onreadystatechange ou autre chose

        const myobj = JSON.parse(this.responseText);
        let resultat = document.getElementById('aff'+id_produit); // récupère le td contenant l'input
        
        for (let data in myobj) {

            resultat.value = myobj[data].afficher_produit;

            if (myobj[data].afficher_produit == 1) {
                resultat.innerHTML = `<img src="public/assets/img/verifier.png" alt="" class="icones_table afficher">`;
            }
            else {
                resultat.innerHTML = `<img src="public/assets/img/verifier.png" alt="" class="icones_table ">`;
            }
        }
    }
    
    data = ('afficher_produit='+ afficher_produit +'&id_produit='+ id_produit);
    // xmlhttp.send(JSON.stringify(data)); // il envoi tout
    xmlhttp.send(data);
    // xmlhttp.send('id='+ selection);
}

let AllProduit = document.querySelectorAll('.btn_aff');
AllProduit.forEach(categorie => {
    let id = categorie.id.replace('aff', '');
    categorie.addEventListener('click', function() {
        let aff = categorie.value;
        gestionAfficher(id,aff);
    });
});