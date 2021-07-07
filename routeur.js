const express = require("express")
const router = express.Router()
var twig = require("twig")
const section = require("./models/sections.modele")
const classe = require("./models/classes.modele")

router.get('/', (req, res) =>{
    res.render("accueil.html.twig")
    console.log("Demande page d'accueil reçue")
})

router.get('/sections', (req, res) =>{  
    console.log("Demande liste des sections reçue")
    section.find()
    .then( datas => {
        res.status(200) 
        res.send(datas)
    } )
    
    .catch(error => res.status(400).json({ error }))
    
    
})

router.get('/eleves', (req, res) =>{
    console.log("Demande liste des élèves reçue")
    res.render("eleves/listedeseleves.html.twig")
})


router.post('/eleves', (req, res) =>{
    res.render("eleves/listedeseleves.html.twig")
})

router.post('/signup', (req, res) =>{
    console.log("Réception d'une demande cliente")
    res.end("Bonjour client")
})

router.post('/login', (req, res) =>{
    console.log("Réception d'une demande cliente")
    res.end("Bonjour client..")
})

module.exports = router