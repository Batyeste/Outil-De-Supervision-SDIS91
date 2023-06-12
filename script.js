// Réinstaller la .js du site web lors d'un refresh
//window.onload = function() {
//         location.reload();     
//       };

// Création des constantes
const groupementsSelect = document.getElementById("groupements");
const localisationSelect = document.getElementById("villes");
const tbody = document.getElementById("equipements");


// Afficher les équipements dans le tableau en fonction de la villes ciblé
const afficherEquipement = function () {
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () { reponseAfficherEquipement(xhr); };
    let requete = "equipements.php"; // Fichier PHP appelé
    xhr.open("POST", requete, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    let index = localisationSelect.selectedIndex;
    let valeur = localisationSelect[index].value;
    let data = "villes=" + valeur;
    //alert(data);
    xhr.send(data);
}


// Fonction de la constante afficherVilles a l'aide des groupements
const afficherVilles = function () {
    let xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () { reponseafficherVilles(xhr); };
    let requete = "villes.php"; // Fichier PHP appelé
    xhr.open("POST", requete, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    let index = groupementsSelect.selectedIndex;
    let valeur = groupementsSelect[index].value;
    let data = "groupements=" + valeur;
   // alert(data);
    xhr.send(data);
}


const effacerVilles = function () {
    while (localisationSelect.hasChildNodes()) {
        localisationSelect.removeChild(localisationSelect.childNodes[0]);
    }
}

// Ce que la fonction fais comme action : ajouter les informations dans le POST
function reponseafficherVilles(xhr) {
    if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
       // alert(xhr.responseText);
       // console.log(xhr.responseText);
        let villes = JSON.parse(xhr.response);
        effacerVilles();
        for (var i = 0; i < villes.length; i++) {
            ajouterVilles(villes[i].loc_id, villes[i].loc_nom);
        }
    }
    effacer();
}


// Ce que la fonction fais comme action : ajouter les informations dans le tableau
function reponseAfficherEquipement(xhr) {
    if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
        let equipement = JSON.parse(xhr.response);
        // alert("tata");
        // alert(xhr.responseText);
        effacer();
        for (var i = 0; i < equipement.length; i++) {
          //  alert(i);
            ajouter(equipement[i].typ_nom, equipement[i].equ_adresseIP, equipement[i].equ_modele);
        }
    }
}

// Pour ajouter les valeurs dans le tableau 
const ajouter = function (type, adresseip, equipement) {
    let ligne = tbody.insertRow(-1);
    let caseType = ligne.insertCell(0);
    let caseAdresseIP = ligne.insertCell(1);
    let caseEquipement = ligne.insertCell(2);
    caseType.innerHTML = type;  
    caseAdresseIP.innerHTML = adresseip;
    caseEquipement.innerHTML = equipement;
  
}

const ajouterVilles = function (loc_id, loc_nom) {
    let option = document.createElement("option");
   // alert(loc_id)
    option.text = loc_nom;
    option.value = loc_id;
    localisationSelect.add(option);
}

const effacer = function () {
    while (tbody.hasChildNodes()) {
        tbody.removeChild(tbody.childNodes[0]);
    }
}
// A la fin du fichier

groupementsSelect.addEventListener("change", afficherVilles);
localisationSelect.addEventListener("change", afficherEquipement);
window.onload = afficherVilles;
