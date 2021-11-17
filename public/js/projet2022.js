const btnSaveActivite = document.querySelector('#save-proposition-activites')
const btnCloseOverlay = document.querySelector('#btn-close-overlay')
const btnShowOverlayAddActivite = document.querySelector('#btn-show-overlay-add-activite')
const overlayAddActivites = document.querySelector('.overlay-add-activite')
const combo_secteur = document.querySelector('#secteurs')
const tablePropositions = document.querySelector('#listOfPropositions')
let message = ""
let inputTest = true

//Ouverture overlay d'ajout d'activité
btnShowOverlayAddActivite.addEventListener('click', (e)=>{
    e.preventDefault()
    overlayAddActivites.classList.remove('d-none')
})

//Fermeture de l'overlay d'ajout d'activité
btnCloseOverlay.addEventListener('click', (e)=>{
    e.preventDefault()
    overlayAddActivites.classList.add('d-none')
})

combo_secteur.addEventListener('change', ()=>{
    if(combo_secteur.value != '#'){
        combo_secteur.classList.add('border-1')
        combo_secteur.classList.add('border-success')
    }
})


//Enregistrement d'une activité proposée
btnSaveActivite.addEventListener('click', (e)=>{
    e.preventDefault()
    let secteur = combo_secteur.value
    let libelle = document.querySelector('#libelle').value.trim()
    let comment = document.querySelector('#comment').value.trim()
    //Test des inputs
    if(secteur == '#'){
        combo_secteur.classList.add('border-2')
        combo_secteur.classList.add('border-danger')
        inputTest = false
    }
    if(libelle == ""){
        document.querySelector('#libelle').classList.add('border-2')
        document.querySelector('#libelle').classList.add('border-danger')
        inputTest = false
    }

    if(inputTest == true) {
        
        //envoi des données
        const data = new FormData()
        data.append('secteur', secteur)
        data.append('libelle', libelle)
        data.append('comment', comment)
        let xhr = new XMLHttpRequest()
        xhr.open("POST", `../../models/projet2022.dao.php?function=insertPropositionOfActivite`)
        xhr.onload = function(){
            combo_secteur.value = "#"
            document.querySelector('#libelle').value = ""
            document.querySelector('#comment').value = ""
            overlayAddActivites.classList.add('d-none')
            loadTableProposition()
        }

        xhr.send(data)
    }
})

function loadTableProposition(){ 
    let xhr = new XMLHttpRequest()
    xhr.open("GET", `../../models/projet2022.dao.php?function=getAllPropositionsOfActivityFromBdd`)
    xhr.onload = function(){
        tablePropositions.innerHTML = ""
        if(this.readyState == 4 && this.status == 200) {
            datas = JSON.parse(this.responseText)
            for(i=0; i<datas.length; i++){
                tablePropositions.innerHTML +=
                `
                <tr> 
                    <td width='5%' class='text-end'>${i}</td> 
                    <td width='20%'>${datas[i].auteur}</td> 
                    <td width='10%'>${datas[i].secteur}</td> 
                    <td width='25%'>${datas[i].libelle}</td> 
                    <td width='25%'>${datas[i].comment}</td> 
                    <td class='d-none'>${datas[i].idactivite}</td> 
                </tr>
                `
            }
            
        }
        message = "a ajouté une proposition d'activité pour le projet2022"
        
        addNotification(message)
    }
    xhr.send()

}

function addNotification(message){
    const data = new FormData()
    data.append('message', message)
    let xhr = new XMLHttpRequest()
    xhr.open("POST", `../../models/projet2022.dao.php?function=addNotification`)
    xhr.onload = function(){
        
    }

    xhr.send(data)
}
 