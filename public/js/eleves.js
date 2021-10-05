
const combo_section = document.querySelector('#sections')
const combo_classe = document.querySelector('#classes')
const nameInput = document.querySelector('#names')
const boutonAfficheEleve = document.querySelector('#submit-btn')
const table = document.querySelector('#listOfEleves')
const boutonAddEleve = document.querySelector('#btn-addEleve')
const showOverlay = document.querySelector('#select-form')
const overlay = document.querySelector('#overlay')
const autoComplete = document.querySelector('#autocom-box')
let searchTerm = ''

let classe = [
    {'id': '1', 'name': '1ère A', 'id_section': '2'},
    {'id': '2', 'name': '1ère B', 'id_section': '2'},
    {'id': '3', 'name': '1ère C', 'id_section': '2'},
    {'id': '4', 'name': '1ère D', 'id_section': '2'},
    {'id': '5', 'name': '1ère E', 'id_section': '2'},
    {'id': '6', 'name': '1ère F', 'id_section': '2'},
    {'id': '7', 'name': '2ème A', 'id_section': '2'},
    {'id': '8', 'name': '2ème B', 'id_section': '2'},
    {'id': '9', 'name': '2ème C', 'id_section': '2'},
    {'id': '10', 'name': '2ème D', 'id_section': '2'},
    {'id': '11', 'name': '3ème Litt', 'id_section': '3'},
    {'id': '12', 'name': '4ème Litt', 'id_section': '3'},
    {'id': '13', 'name': '5ème Litt', 'id_section': '3'},
    {'id': '14', 'name': '6ème Litt', 'id_section': '3'},
    {'id': '15', 'name': '3ème Scient A', 'id_section': '4'},
    {'id': '16', 'name': '3ème Scient B', 'id_section': '4'},
    {'id': '17', 'name': '4ème Scient A', 'id_section': '4'},
    {'id': '18', 'name': '4ème Scient B', 'id_section': '4'},
    {'id': '19', 'name': '5ème Bio-Chimie', 'id_section': '4'},
    {'id': '20', 'name': '6ème Bio-Chimie', 'id_section': '4'},
    {'id': '21', 'name': '5ème Math-Phys', 'id_section': '4'},
    {'id': '22', 'name': '6ème Math-Phys', 'id_section': '4'},
]

//Si on sélectionne une section, chargement du combo_classe
combo_section.addEventListener('change', ()=>{
    table.innerHTML = ""
    boutonAddEleve.classList.add("d-none")
    if (combo_section.value != '#'){
        combo_classe.innerHTML = ""
        combo_classe.innerHTML += `<option value="#" selected="selected" >Sélectionner</option>`
        for(i=0; i<classe.length; i++){
            if((classe[i].id_section == combo_section.value) && (classe[i].id_section != 1)) {
                combo_classe.innerHTML += `<option value="${classe[i].id}">${classe[i].name}</option>`
            }
        }
    }
})

//Affichage liste des élèves d'une classe au click sur le combo classe
combo_classe.addEventListener('change', ()=>{
    table.innerHTML = ""
    if(combo_classe.value != '#'){
        var xhr = new XMLHttpRequest()
        xhr.onreadystatechange = function(){
            boutonAddEleve.classList.remove("d-none")
            if(this.readyState == 4 && this.status == 200) {
                const eleves = JSON.parse(this.responseText)
                
                if(eleves.length >0){
                    let num = 1
                    for(i=0; i<eleves.length; i++) {
                        table.innerHTML += `
                        <tr>
                            <td width='5%' class='text-end'>${num}</td>
                            <td width='5%' class='d-none'>${eleves[i].id}</td>
                            <td width='30%'>${eleves[i].names}</td>
                            <td width='20%'>${eleves[i].firstname}</td>
                            <td width='30%'>${eleves[i].commune}</td>
                        </tr>`
                        num++;
                    }
                }
                else {
                    table.innerHTML = `
                    <tr class='text-center pt-3'>
                        <td colspan='5' class='text-center pt-3'>
                            <div class='alert alert-danger my-0' role='alert'>Aucun élève n'a été trouvé dans cette classe</div>
                        </td>
                    </tr>`
                }
            }
        }
        xhr.open("GET", `../../models/eleves.dao.php?idclasse=${combo_classe.value}&function=getElevesByClassFromBdd`, true)
        xhr.send()
    }
})


//Affichage de l'overlay quand on clique sur le bouton Ajouter un élève 
showOverlay.addEventListener('submit', (e)=>{
    e.preventDefault()
    getListEleves()
})

//filter la saisie utilisateur et charger la modale
nameInput.addEventListener('input', (e) => {
    searchTerm = e.target.value //Je récupère tout ce qui est tapé dans l'input
    getListEleves()
})


//Fonction pour récupérer la liste des élèves '
function getListEleves(){
    autoComplete.innerHTML = ""
    overlay.classList.remove('d-none')
    autoComplete.style.opacity = '1'
    var xhr = new XMLHttpRequest()
    xhr.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200) {
            const eleves = JSON.parse(this.responseText)
            loadModale(eleves)
        } else {
            $errorMessage = "Un problème est survenu";
            //require_once("www.acb92.com/views/common/erreur.views.php") ;
        }
    }
    xhr.open("GET", `../../models/eleves.dao.php?function=getAllElevesFromBdd`, true)
    xhr.send()
}

//Fonction pour charger la modale
function loadModale(datas){
    autoComplete.innerHTML = (
        datas.filter(data => data.names.toLowerCase().includes(searchTerm.toLowerCase())) 
        .map(data => ( 
            `
            <div>
                <li class='py-1' >
                    <span id='overlay-id-item' class='d-none'>${data.id}</span>
                    <span id='overlay-name-item'>${data.names}</span>
                    <span id='overlay-firstname-item'>${data.firstname}</span>
                    <span id='overlay-commune-item' class='d-none'>${data.commune}</span>
                </li>
            </div>
            `
        ))
        .join('') 
        
    )
}



//Fermeture de l'overlay
document.querySelector('.close').addEventListener('click', ()=>{
    overlay.classList.add('d-none')
    autoComplete.innerHTML = ""
})