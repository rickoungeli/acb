
const combo_section = document.querySelector('#sections')
const combo_classe = document.querySelector('#classes')
const nameInput = document.querySelector('#names')
const boutonAfficheEleve = document.querySelector('#submit-btn')
const table = document.querySelector('#listOfEleves')
const boutonAddEleve = document.querySelector('#btn-add-eleve')
const overlay = document.querySelector('#overlay')
const autoComplete = document.querySelector('#autocom-box')
const btnSaveEleve = document.querySelector('#form-group3')
let searchTerm = ''
let datas = []
let ideleve = ""

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

//au click sur le combo classe, Affichage liste des élèves d'une classe 
combo_classe.addEventListener('change', ()=>{
    boutonAddEleve.classList.remove('d-none')
    showListOfClass()
})

//Au click du btnddEleve, Afficher l'overlay et charger tous les élèves dans la modale  
boutonAddEleve.addEventListener('click', (e)=>{
    e.preventDefault()
    autoComplete.style.opacity='1'
    getAllElevesFromBdd()
    showOverlay()
    //maskInput()
})


//filter la saisie utilisateur et charger la modale
nameInput.addEventListener('input', (e) => {
    searchTerm = e.target.value //Je récupère tout ce qui est tapé dans l'input
    if(searchTerm=="")  {maskInput()} 
    loadListEleve(datas) 
})

//Enregistrement d'un élève dans une classe
btnSaveEleve.addEventListener('click', (e)=>{
    e.preventDefault()
    saveEleve()
})


//Fermeture de l'overlay
document.querySelector('.close').addEventListener('click', ()=>{
    searchTerm == ""
    closeOverlay()
})

function getAllElevesFromBdd(){
    var xhr = new XMLHttpRequest()
    xhr.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200) {
            datas = JSON.parse(this.responseText)
            loadListEleve(datas)
        } else {
            $errorMessage = "Un problème est survenu";
            //require_once("www.acb92.com/views/common/erreur.views.php") ;
        }
    }
    xhr.open("GET", `../../models/eleves.dao.php?function=getAllElevesFromBdd`, true)
    xhr.send()
}

function loadListEleve(datas){
    autoComplete.innerHTML = ""
    for(i=0; i<datas.length; i++){
        if(datas[i].names.toLowerCase().includes(searchTerm.toLowerCase())) {
            maskInput()
            autoComplete.innerHTML +=
            `
            <li class='py-1 btn w-100 text-start data' onclick="printInModale(${datas[i].id}, '${datas[i].names}', '${datas[i].firstname}', '${datas[i].commune}')">
                <span id='overlay-id-item' class='d-none'>${datas[i].id}</span>
                <span id='overlay-name-item'>${datas[i].names}</span>
                <span id='overlay-firstname-item'>${datas[i].firstname}</span>
                <span id='overlay-commune-item' class='d-none'>${datas[i].commune}</span>
            </li>
            `
        }
    }
    if(autoComplete.innerHTML == ""){
        showInput()
    }
}


function showOverlay(){
    overlay.classList.remove('d-none')
}

function closeOverlay(){
    document.querySelector('#id').value = ""
    document.querySelector('#names').value = ""
    document.querySelector('#firstname').value = ""
    document.querySelector('#commune').value = ""
    autoComplete.innerHTML = ""
    searchTerm=""
    overlay.classList.add('d-none')
}

function showInput(){
    autoComplete.classList.add('d-none')
    document.querySelector('#form-group1').classList.remove('d-none')
    document.querySelector('#form-group2').classList.remove('d-none')
    document.querySelector('#form-group3').classList.remove('d-none')
}

function maskInput(){
    autoComplete.classList.remove('d-none')
    document.querySelector('#form-group1').classList.add('d-none')
    document.querySelector('#form-group2').classList.add('d-none')
    document.querySelector('#form-group3').classList.add('d-none')
}


function printInModale(id, names, firstname, commune){
    document.querySelector('#id').value = id
    document.querySelector('#names').value = names
    document.querySelector('#firstname').value = firstname
    document.querySelector('#commune').value = commune
    showInput()
}

function showListOfClass(){
    closeOverlay()
    table.innerHTML = ""
    if(combo_classe.value != '#'){
        let xhr = new XMLHttpRequest()
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
}

function saveEleve(){
    ideleve = document.querySelector('#id').value 
    let names = document.querySelector('#names').value.toUpperCase().trim()
    let firstname = document.querySelector('#firstname').value.trim()
    let commune = document.querySelector('#commune').value.trim()
    //si l'id est fourni, l'eleve existe déjà dans la bdd sinon il faut d'abord enregistrer l'élève
    //if(names!=""){
        if(ideleve=="") {
            //Test des inputs



            createNewEleve(names, firstname, commune)
        } 
        saveEleveInClasse(ideleve, combo_classe.value)
    /*
    } else {
        names.value = ""
        closeOverlay()
    }
    */
   
}

function createNewEleve(names, firstname, commune, ideleve){
    const data = new FormData()
    data.append('names', names)
    data.append('firstname', firstname)
    data.append('commune', commune)
    let xhr = new XMLHttpRequest()
    xhr.open("POST", `../../models/eleves.dao.php?function=createNewEleve`)
    xhr.onload = function(){
            getIdEleve(names, firstname)
    }

    xhr.send(data)
}

function getIdEleve(names, firstname){
    //const data = new FormData()
    //data.append('names', names)
    //data.append('firstname', firstname)
    let xhr = new XMLHttpRequest()
    xhr.onload = function(){
        let id = JSON.parse(this.responseText)
        ideleve = id.id
        console.log(ideleve);
        saveEleveInClasse(ideleve, combo_classe.value)
        //return ideleve
    }
    xhr.open("GET", `../../models/eleves.dao.php?function=getIdEleve&names=${names}&firstname=${firstname}`)
    xhr.send()
}

function saveEleveInClasse(ideleve, idclasse){
    console.log(ideleve);
    const data = new FormData()
    data.append('ideleve', ideleve)
    data.append('idclasse', idclasse)
    let xhr = new XMLHttpRequest()
    xhr.open("POST", `../../models/eleves.dao.php?function=saveEleveInClass`)
    xhr.onload = function(){
        showListOfClass()
    }
    xhr.send(data)
}
