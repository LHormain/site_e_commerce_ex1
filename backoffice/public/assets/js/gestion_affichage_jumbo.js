//-----------------------------------------------------------------
//    gestion de l'affichage ou non d'un paragraphe 
//           du jumbotron de l'accueil
//-----------------------------------------------------------------

function gestionAfficher(id_paragraphe, afficher_paragraphe) {
    // création de l'objet XHLHttpRequest
    const xmlhttp = new XMLHttpRequest(); 
    
    xmlhttp.open("POST", "controler/requete_gestion_affichage_jumbo.php", true); // il va chercher le fichier et l'ouvre
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); // obligatoire pour post
    xmlhttp.onload = function() { // peut aussi utiliser onreadystatechange ou autre chose

        const myobj = JSON.parse(this.responseText);
        let resultat = document.getElementById(id_paragraphe); // récupère le td contenant l'input
        
        for (let data in myobj) {
                        
            resultat.value = myobj[data].afficher_paragraphe;

            if (myobj[data].afficher_paragraphe == 1) {
                resultat.innerHTML = `<img src="public/assets/img/verifier.png" alt="" class="icones_table afficher">`;
            }
            else {
                resultat.innerHTML = `<img src="public/assets/img/verifier.png" alt="" class="icones_table ">`;
            }
        }
    }
    
    data = ('afficher_paragraphe='+ afficher_paragraphe +'&id_paragraphe='+ id_paragraphe);
    // xmlhttp.send(JSON.stringify(data)); // il envoi tout
    xmlhttp.send(data);
    // xmlhttp.send('id='+ selection);
}

let AllCat = document.querySelectorAll('.btn_aff');
AllCat.forEach(categorie => {
    let id = categorie.id;
    categorie.addEventListener('click', function() {
        let aff = categorie.value;
        gestionAfficher(id,aff);
    });
});