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
                    <div class='row no-gutters text-start'>
                        <div class='col-10' onclick='showCommentDiv(${datas.indexOf(data)}, ${data.idactivite}, 0)' >
                            <span class='btn fw-bold text-start' >Voir les commentaires </span> 
                            <img src='public/images/icones/rocketchat-brands.svg' class='d-inline m-0 p-0' style='max-height: 20px; color: rgb(34, 33, 33);'>  
                        </div>
                        <div class='col-2 d-flex text-end like'>
                            <span>
                                <label for='like' class='d-flex'>
                                    <span class='me-1 d-none d-md-inline like3'>J'aime </span> 
                                    <img src='public/images/icones/thumbs-up-regular.svg' class='like1 m-0 p-0' style='max-height: 20px; color: rgb(34, 33, 33);'>
                                    <img src='public/images/icones/thumbs-up-solid-svg.svg' class='like2 m-0 p-0 d-none' style='max-height: 20px; color: blue;'> 
                                </label>
                                <input type='checkbox' id='like' class='d-none'/>
                            </span>
                        </div>
                    </div>
                    <div id='div' class='p-2 d-none' style='min-height:20px;'>
                    </div>
                    <form method='post' class='d-flex commentForm' onsubmit=saveComment>
                        <input id='input' type='text' class='comment form-control m-2' placeholder='Votre question ou commentaire'>
                        <input type='hidden' value=${datas.indexOf(data)} class='index '>
                        <input type='hidden' value=${data.idactivite} class='idpost '>
                        <input type='submit' value='>>>' class='submitbtn btn py-0 px-2 me-2 mt-2 border border-secondary rounded text-align-center'> 
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

function showCommentDiv(index, idpost, codeOpen){
    datas=[]
    let article = document.getElementById(`${index}`) 
    console.log(savedIndex);   
    fetch(`https://www.acb92.com/models/projet2022.dao.php?function=getAllCommentOfProjet2022&idactivite=${idpost}`)
    .then(res => res.json())
    .then(datas => {
        
        codeOpen==1 ? article.querySelector('#div').classList.remove('d-none') : article.querySelector(`#div`).classList.toggle('d-none')
        if(datas.length>0){
            article.querySelector('#div').innerHTML = (
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
            article.querySelector(`#div`).innerHTML =`<div class='alert alert-danger py-0 my-0'>Aucun commentaire n'a été posté</div>`
        }
        
        if (savedIndex != 100000000000000000 && savedIndex != index) {
            let article1 = document.getElementById(`${savedIndex}`) 
            
            article1.querySelector('#div').classList.add('d-none')
        }
        savedIndex = index
        
    })    

}

//Ajout d'un commentaire
setTimeout(()=>{
    let forms = document.querySelectorAll('.commentForm')
    for(let form of forms){
        
        form.addEventListener('submit', (e)=>{
            e.preventDefault()
            let content = form.querySelector('.comment').value
            let index = form.querySelector('.index').value
            let id_post = form.querySelector('.idpost').value
            form.querySelector('.comment').value=""
            saveComment(index, id_post, content)
        })
    }
},200)

//Ajout d'un j'aime
setTimeout(()=>{
    let likes = document.querySelectorAll('.like')
    for(let like of likes){
        like.addEventListener('click', ()=>{
            let clicked = like.querySelector('#like').checked
            if (clicked == true) {
                like.querySelector('.like1').classList.add('d-none')
                like.querySelector('.like2').classList.remove('d-none')
                like.querySelector('.like3').style.color='blue'
            } else {
                like.querySelector('.like1').classList.remove('d-none')
                like.querySelector('.like2').classList.add('d-none')
                like.querySelector('.like3').style.color='black'
            }
            
            
        
        })
    }
},200)

function saveComment(index, id_post, content){
    
    const data = new FormData()
    data.append('id_post', id_post)
    data.append('id_user', document.querySelector('#id-user').value)
    data.append('content', content)
    fetch('https://www.acb92.com/models/projet2022.dao.php?function=addComment', { method: 'POST', body: data })
    .then((res) => {
        res.status==200? showCommentDiv(index, id_post, 1) : console.log(res.status);
    })
    .catch(err => {
        $errorMessage = "Un problème est survenu";
        console.log($errorMessage);
    })

    
    
}


