const mongoose = require("mongoose")

//Schéma des données 
//La méthode schema() de mongoose permet de définir un schéma des données
const sectionSchema = mongoose.Schema({ 
    _id : mongoose.Schema.Types.ObjectId,
    nom: String  
})
module.exports = mongoose.model('Sections', sectionSchema)