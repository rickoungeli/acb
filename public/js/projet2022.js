const btnSaveActivite = document.querySelector('#save-proposition-activites')
const btnCloseOverlay = document.querySelector('#btn-close-overlay')
const btnShowOverlayAddActivite = document.querySelector('#btn-show-overlay-add-activite')
const overlayAddActivites = document.querySelector('.overlay-add-activite')
const combo_secteur = document.querySelector('#secteurs')
const tablePropositions = document.querySelector('#listOfPropositions')
const sectionActivites = document.querySelector('#section-activites')
let message = ""
let inputTest = true
let savedIndex = 100000000000000000
let clickedIndex = 0

loadSectionActivites()


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
            loadSectionActivites()
        }

        xhr.send(data)
    }
})

function loadSectionActivites(){ 
    sectionActivites.innerHTML = ""
    fetch(`https://www.acb92.com/models/projet2022.dao.php?function=getAllPropositionsOfActivityFromBdd`)
    .then(res => res.json())
    .then(datas => {
        if(datas.length>0){
            sectionActivites.innerHTML = (
                datas
                .map(data => (
                
                `
                <article id=${datas.indexOf(data)} class='card mb-2 p-1 smal-shadow border border-danger'>
                    <div class='d-flex justify-content-between bg-light-fonce '>
                        <!-- L'UTILISATEUR QUI A PUBLIE -->
                        <div class='d-flex' id='user-infos'> 
                            <img src='../../public/images/profil_picture.png' style='width : 50px;' class='card-img-top profil-picture rounded-circle' alt=''>
                            <div class='card-text d-flex flex-column'>
                                <p class='d-none'>${data.idactivite} </p>
                                <p class='text-white fw-bold m-0 text-shadow'> ${data.auteur} </p>
                                <small class='text-white m-0'> Publiée le ${data.date_cre} </small>
                            </div>
                        </div>
            
                        <!-- MENU PUBLICATIONS -->
                        <nav class='nav-item dropdown me-2 rounded-circle'>
                            <span class='btn rounded-circle text-center' id='navbarDropdown' role='button' data-bs-toggle='dropdown' aria-expanded='false' >
                                <i class='fas fa-ellipsis-v align-middle'></i>
                            </span>
                            <ul class='dropdown-menu bg-secondary post-menu '>
                                <li class='dropdown-item text-white btn'><i class='fa fa-paste'></i> Modifier <span class='d-none'>${data.idactivite}</span></li>
                                <li><hr class='dropdown-divider text-white'></li>
                                <li class='dropdown-item text-white btn'><i class='fa fa-trash-o'></i>  Supprimer <span class='d-none'>${data.idactivite}</span></li>
                            </ul>
                        </nav>
                    </div>
                    <h4 class='card-title p-1 pt-2 fw-bold text-uppercase text-secondary shadow '>${data.libelle}</h4>
                        
                    <div class='card-body p-2'>    
                    <div class='card-text'>
                    <p class='m-0 mt-2'>${data.comment}</p>
                    </div>  
                    </div>
                    <!-- FORMULAIRE DE SAISIE D'UN COMMENTAIRES -->
                    <form name='form-new-comment'>
                        <div onclick='showCommentDiv(${datas.indexOf(data)}, ${data.idactivite})' class='btn fw-bold' >Voir les commentaires</div>
                        <div id='div' class='comment p-2 d-none' style='min-height:20px;'>
                        </div>
                        <div class='d-flex'> 
                            <input id='input' type='text' class='form-control m-2' placeholder='Votre question ou commentaire'>
                            <button onclick='saveComment(${datas.indexOf(data)}, ${data.idactivite})' class='btn py-0 px-2 me-2 mt-2 border border-secondary rounded text-align-center disabled'> >>> </button>
                        </div>
                    </form>
                </article>
                `
                )).join('')
                
            
            )
            message = "a ajouté une proposition d'activité pour le projet2022"
            addNotification(message)
        } else {        
            sectionActivites.innerHTML = `
                <tr class='text-center pt-3'>
                    <td colspan='5' class='text-center pt-3'>
                        <div class='alert alert-danger my-0' role='alert'>Aucune activité n'a été proposée</div>
                    </td>
                </tr>`
        }
    })
    .catch(err => {
        $errorMessage = "Un problème est survenu";
        console.log(err);
    })

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

function showCommentDiv(index, idactivite){
    datas=[]
    let article = document.getElementById(`${index}`)     
    fetch(`https://www.acb92.com/models/projet2022.dao.php?function=getAllCommentOfProjet2022&idactivite=${idactivite}`)
    .then(res => res.json())
    .then(datas => {

        
        if(datas.length>0){



            if (index != savedIndex) {
                article.querySelector(`#${savedIndex}`).classList.toggle('d-none')
                savedIndex = index

            }
        }
        article.querySelector(`#div`).classList.toggle('d-none')
        loadCommentDiv(datas, index)
        
    })    

}


function loadCommentDiv(datas, index){
    let article = document.getElementById(`${index}`)
    if(datas.length>0){
        article.querySelector(`#div`).innerHTML = (
            datas
            .map(data => (
                `
                <h6 class='text-secondary'>${data.userfirstname} ${data.username}</h6>
                <div>${data.content}</div>
                <hr>
                `
            )).join('')
            
        )
    } else {
        article.querySelector(`#div`).innerHTML =`<div class='alert alert-danger'>Aucun commentaire n'a été posté</div>`
    }

    
}
