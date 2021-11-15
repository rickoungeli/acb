const btnSaveActivite = document.querySelector('#save-proposition-activites')
const btnCloseOverlay = document.querySelector('#btn-close-overlay')
const btnShowOverlayAddActivite = document.querySelector('#btn-show-overlay-add-activite')
const overlayAddActivites = document.querySelector('.overlay-add-activite')

//Ouverture overlay d'ajout d'activité
btnShowOverlayAddActivite.addEventListener('click', (e)=>{
    e.preventDefault()
    overlayAddActivites.classList.remove('d-none')
})

//Fermeture de l'overlay d'ajout d'activité
btnCloseOverlay.addEventListener('click', ()=>{
    overlayAddActivites.classList.add('d-none')
})

//Enregistrement d'une activité proposée
btnSaveActivite.addEventListener('click', (e)=>{
    e.preventDefault()
})