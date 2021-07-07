const express = require("express")
const server = express()
const morgan = require("morgan")
const router = require("./routeur")
const mongoose = require("mongoose")

server.use(express.static("public"))
server.use(morgan("dev"))
server.use("/", router)



//Connexion de l'API à la base de données 
//mongoose.connect('mongodb+srv://admin:admin@cluster0.akvy0.mongodb.net/myFirstDatabase?retryWrites=true&w=majority', { useNewUrlParser: true, useUnifiedTopology: true })
mongoose.connect("mongodb://localhost/acb", { useNewUrlParser: true, useUnifiedTopology: true })
.then( console.log("connexion réussie") )

const sectionModel = require("./models/sections.modele")
const classeModel = require("./models/classes.modele")



server.listen(3000)


