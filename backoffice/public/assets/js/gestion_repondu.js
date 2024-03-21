// -------------------------------------------------------
//      pour changer le statut répondu dans le tableau
// -------------------------------------------------------

function gestionAfficher(id_contact, repondu_message) {
    // création de l'objet XHLHttpRequest
    const xmlhttp = new XMLHttpRequest(); 
    
    xmlhttp.open("POST", "controler/requete_gestion_repondu.php", true); // il va chercher le fichier et l'ouvre
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); // obligatoire pour post
    xmlhttp.onload = function() { // peut aussi utiliser onreadystatechange ou autre chose
         
        const myobj = JSON.parse(this.responseText);
        let resultat = document.getElementById(id_contact); // récupère le td contenant l'input
        
        for (let data in myobj) {
            
            if (myobj[data].repondu_message == 1) {
                resultat.innerHTML = `<img src="public/assets/img/verifier.png" alt="" class="icones_table afficher">`;
            }
            else {
                resultat.innerHTML = `<img src="public/assets/img/verifier.png" alt="" class="icones_table ">`;
            }
        } 
    }
    
    data = ('repondu_message='+ repondu_message +'&id_contact='+ id_contact);
    // xmlhttp.send(JSON.stringify(data)); // il envoi tout
    xmlhttp.send(data);
    // xmlhttp.send('id='+ selection);
}

let AllCat = document.querySelectorAll('.btn_aff');
AllCat.forEach(categorie => {
    let id = categorie.name;
    categorie.addEventListener('click', function() {
        let aff = categorie.value;
        gestionAfficher(id,aff);
    });
});