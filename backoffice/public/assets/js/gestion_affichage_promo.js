//-----------------------------------------------------------------
//    gestion de l'affichage ou non d'un produit 
//           dans la promotion du jumbotron
//-----------------------------------------------------------------

function gestionAfficherPromo(id_produit, promo_saison_produit) {
    // création de l'objet XHLHttpRequest
    const xmlhttp = new XMLHttpRequest(); 
    
    xmlhttp.open("POST", "controler/requete_gestion_affichage_promo.php", true); // il va chercher le fichier et l'ouvre
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); // obligatoire pour post
    xmlhttp.onload = function() { // peut aussi utiliser onreadystatechange ou autre chose

        const myobj = JSON.parse(this.responseText);
        let resultat = document.getElementById('promo'+id_produit); // récupère le td contenant l'input
        
        for (let data in myobj) {
            
            resultat.value = myobj[data].promo_saison_produit;

            if (myobj[data].promo_saison_produit == 1) {
                resultat.innerHTML = `<img src="public/assets/img/verifier.png" alt="" class="icones_table afficher">`;
            }
            else {
                resultat.innerHTML = `<img src="public/assets/img/verifier.png" alt="" class="icones_table ">`;
            }
        }
    }
    
    data = ('promo_saison_produit='+ promo_saison_produit +'&id_produit='+ id_produit);
    // xmlhttp.send(JSON.stringify(data)); // il envoi tout
    xmlhttp.send(data);
    // xmlhttp.send('id='+ selection);
}

let AllCat = document.querySelectorAll('.btn_promo');
AllCat.forEach(categorie => {
    let id = categorie.id.replace('promo', '');
    categorie.addEventListener('click', function() {
        let aff = categorie.value;
        gestionAfficherPromo(id,aff);
    });
});