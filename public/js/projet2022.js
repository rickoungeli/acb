const btnSaveActivite = document.querySelector('#save-proposition-activites')
const btnCloseOverlay = document.querySelector('#btn-close-overlay')
const btnShowOverlayAddActivite = document.querySelector('#btn-show-overlay-add-activite')
const overlayAddActivites = document.querySelector('.overlay-add-activite')
const combo_secteur = document.querySelector('#secteurs')
const tablePropositions = document.querySelector('#listOfPropositions')
const sectionActivites = document.querySelector('#section-activites')
let message = ""
let inputTest = true

loadTableActivites()


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
            loadTableActivites()
        }

        xhr.send(data)
    }
})

function loadTableActivites(){ 
    fetch('https://www.acb92.com/models/projet2022.dao.php?function=getAllPropositionsOfActivityFromBdd')
    .then(res => res.json())
    .then(datas => {
        sectionActivites.innerHTML = (
            datas
            .map(data => (
            `
            <article class='card mb-2 p-1 smal-shadow'>
                <div class='d-flex justify-content-between bg-light-fonce '>
                    <!-- L'UTILISATEUR QUI A PUBLIE -->
                    <div class='d-flex' id='user-infos'> 
                        <img src='../../public/images/profil_picture.png' style='width : 50px;' class='card-img-top profil-picture rounded-circle' alt=''>
                        <div class='card-text d-flex flex-column'>
                            <p class='d-none'>${data.idactivite}</p>
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
                <form class='d-flex' name='form-new-comment'>
                    <input type='text' class='form-control m-2 disabled' placeholder='La fonction commentaire n est pas encore disponible'>
                    <button class='btn py-0 px-2 me-2 mt-2 border border-secondary rounded text-align-center disabled'> >>> </button>
                </form>
            </article>
            `
            ))
            
        
        )
        message = "a ajouté une proposition d'activité pour le projet2022"
        addNotification(message)
    })        
    .catch(err => {
        $errorMessage = "Un problème est survenu";
        console.log($errorMessage);
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
 
function getAllActivites(){
    console.log("bonjoureeee")
    sectionActivites.innerHTML = ""
    fetch(`https://www.acb92.com/models/projet2022.dao.php?function=getAllPropositionsOfActivityFromBdd`)
    .then(res => res.json())
    .then(datas => {
        console.log(datas)
        if(datas.length >0){
            showListOfActivites(datas);
        }
        else {
            table.innerHTML = `
            <tr class='text-center pt-3'>
                <td colspan='5' class='text-center pt-3'>
                    <div class='alert alert-danger my-0' role='alert'>Aucune n'a été proposée</div>
                </td>
            </tr>`
        }
    
    })
    .catch(err => {
        $errorMessage = "Un problème est survenu";
        console.log(err);
    })
}

function showListOfActivites(datas){
    datas
    .map(data => (
         `
        <article class="card mb-2 p-1">
            <div class="d-flex justify-content-between bg-light-fonce">
                <!-- L'UTILISATEUR QUI A PUBLIE -->
                <div class="d-flex" id='user-infos'> 
                    <img src="../../public/images/profil_picture.png" style="width : 50px;" class="card-img-top profil-picture rounded-circle" alt=""> 
                    <div class="card-text d-flex flex-column">
                        <p class="d-none">${data.idactivite}</p>
                        <p class="fw-bold m-0 text-shadow"> ${data.auteur}  </p>
                        <small class=" m-0"> Publiée le ${data.date_cre} </small>
                    </div>
                </div>

                <!-- MENU PUBLICATIONS -->
                <nav class="nav-item dropdown me-2 rounded-circle">
                    <span class="btn rounded-circle text-center" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" >
                        <i class="fas fa-ellipsis-v align-middle"></i>
                    </span>
                    <ul class="dropdown-menu bg-secondary post-menu ">
                        <li class="dropdown-item text-white btn"><i class="fa fa-paste"></i> Modifier <span class="d-none">${idactivite}</span></li>
                        <li><hr class="dropdown-divider text-white"></li>
                        <li class="dropdown-item text-white btn"><i class="fa fa-trash-o"></i>  Supprimer <span class="d-none">${idactivite}</span></li>
                    </ul>
                </nav>
            </div>
            <h4 class="card-title text-danger fw-bold text-uppercase text-decoration-underline">${libelle}</h4>
            
            <div class="card-body p-2">    
                <div class="card-text">
                    <p class="m-0">${comment}</p>
                </div>  
            </div>
            <!-- FORMULAIRE DE SAISIE D'UN COMMENTAIRES -->
            <form class="d-flex" name="form-new-comment">
                <input type="text" class="form-control m-2 " placeholder="Votre commentaire">
                <button class="btn py-0 px-3 me-2 mt-2 border border-secondary rounded text-align-center">Ajouter</button>
            </form>
        </article>
    `))
}
