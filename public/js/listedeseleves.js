const anneeScolaire = document.querySelector('#annee-scolaire')
const section = document.querySelector("#section")


anneeScolaire.addEventListener("click", (e)=>{
    if(e.target.value!="#") remplirComboSection()
})

function remplirComboSection() {
    fetch ("http://localhost:3000/sections") //Requete pour recupérer les section
    
    .then(res => res.json()) 
    .then(datas => {
        //Traitement de chaque élément (data) de l'objet datas   
        section.innerHTML = `<option value="#" checked="checked">Section</option>`
        for (i=0; i < datas.length; i++) {
            
            
            const option = document.createElement("option")
            option.setAttribute("value", datas[i]._id)
            option.innerHTML = datas[i].nom
            
            section.appendChild(option)  
            
        }
         
    })
    
}   
