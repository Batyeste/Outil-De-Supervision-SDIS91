window.onload = function() {
    //         location.reload();     
    checkbox = document.querySelectorAll(".checkbox_suppr")
    
    console.log(checkbox)
        };
    
    // Création des constantes
    const groupementsSelect = document.getElementById("groupements");
    const localisationSelect = document.getElementById("villes");
    const tbody = document.getElementById("equipements");
    
    
    // Afficher les équipements dans le tableau en fonction de la ville ciblée
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
        //console.log(data);
    }
    
    
    // Fonction de la constante afficherVilles à l'aide des groupements
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
    
    // Ce que la fonction fait comme action : ajouter les informations dans le POST
    function reponseafficherVilles(xhr) {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            // alert(xhr.responseText);
            // console.log(xhr.responseText);
            let villes = JSON.parse(xhr.response);
            //console.log(villes);
            effacerVilles();
            for (var i = 0; i < villes.length; i++) {
                ajouterVilles(villes[i].loc_id, villes[i].loc_nom, villes[i].loc_groid);
            }
        }
        effacer();
    }
    
    
    // Ce que la fonction fait comme action : ajouter les informations dans le tableau
    function reponseAfficherEquipement(xhr) {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
            let equipement = JSON.parse(xhr.response);
            // alert("tata");
            // alert(xhr.responseText);
            effacer();
            for (var i = 0; i < equipement.length; i++) {
                // console.log(i);
                ajouter(equipement[i].typ_nom, equipement[i].equ_adresseIP, equipement[i].equ_modele, equipement[i].loc_nom, equipement[i].equ_id);
            }
        }
    }
    
    // Pour ajouter les valeurs dans le tableau
    const ajouter = function (type, adresseip, equipement, ville, equ_idm) {
        
        let ligne = tbody.insertRow(-1);
        let caseEtat = ligne.insertCell(0);
        let caseType = ligne.insertCell(1);
        let caseAdresseIP = ligne.insertCell(2);
        let caseEquipement = ligne.insertCell(3);
        let caseVille = ligne.insertCell(4);
        let caseSuppressions = ligne.insertCell(5);
    
        caseEtat.innerHTML = pingresult[adresseip] || '';
        caseType.innerHTML = type;
        caseAdresseIP.innerHTML = adresseip;
        caseEquipement.innerHTML = equipement;
        caseVille.innerHTML = ville;
    
        const caseACocher = document.createElement('input');
        caseACocher.type = 'checkbox';
        caseACocher.className = 'checkbox_suppr';
        caseACocher.name = 'equ_idm[]';
        caseACocher.value = equ_idm;
        // Ajoute la checkbox dans les cellules
        caseSuppressions.appendChild(caseACocher);
        //console.log(pingresult);
    }
    
    
    const ajouterVilles = function (loc_id, loc_nom, loc_groid) {
        let option = document.createElement("option");
        if (loc_id == 54) {
            option.defaultSelected = '';
            option.text = loc_nom;
            option.value = loc_id + '_' + loc_groid;
        }
        else {
            option.text = loc_nom;
            option.value = loc_id + '_' + loc_groid;
        }
        localisationSelect.add(option);
    }
    
    function supprimerLigne(btn) {
        let row = btn.parentNode.parentNode;
        let checkbox = row.querySelector('.delete-checkbox');
        if (checkbox.checked) {
            row.parentNode.removeChild(row);
        }
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
    
    
    btn_suppr = document.getElementById("btnDelete")
    
    btn_suppr.addEventListener("click",SupprimerLigne())
    
    function SupprimerLigne(){
        checkbox = document.querySelectorAll(".checkbox_suppr")
        console.log(checkbox)
    
        // Verifier si sur le clique du boutton " supprimer" je reconnais les checkbox selectionner
        // Si element trouver, supprimer les elements
    
    
       /* for(let i = 0; i <checkbox.checked;i++){
           
    }*/
    }