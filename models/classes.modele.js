const mongoose = require("mongoose")

//Schéma des données 
//La méthode schema() de mongoose permet de définir un schéma des données
const classeSchema = mongoose.Schema({ 
    _id : mongoose.Schema.Types.ObjectId,
    nom: String,
    nomElargi: String,
    section_Id: Number  
})
module.exports = mongoose.model('Classes', classeSchema)