<?php 

/*
const HOST_NAME = "nsxuijracb92.mysql.db";
const DATABASE_NAME = "nsxuijracb92";
const USER_NAME = "nsxuijracb92";
const PASSWORD = "Le29011974";
*/
require_once("config/config.php");
require_once("pdo.php");

if(isset($_GET['function']) && !empty($_GET['function'])){
    $function = $_GET['function'] ;
    switch ($function) {
        case "getAllElevesFromBdd" : getAllElevesFromBdd() ;
            break ;
        case "getAllElevesOfClasse" : 
            $idclasse = $_GET['idclasse'];
            getAllElevesOfClasse($idclasse) ;
            break ;
        case "getAllElevesOfSection" : 
            $idsection = $_GET['idsection'];
            getAllElevesOfSection($idsection) ;
            break ;
        case "createNewEleve" : createNewEleve() ;
            break ;
        case "saveEleveInClass" : 
            saveEleveInClass() ;
            break ;
        case "getIdEleve" : getIdEleve() ;
            break ;
    }
}
function createNewEleve(){
    $names = $_POST['names'];
    if($_POST['firstname'] != "") {$firstname = $_POST['firstname'];} else {$firstname = "";}
    if($_POST['commune'] != "") {$commune = $_POST['commune'];} else {$commune = "";}
    $bdd = connexionPDO();
    $req = "INSERT INTO eleves (names, firstname, commune) VALUES (:names, :firstname, :commune)" ;
    $stmt = $bdd -> prepare($req) ;
    $stmt->bindValue(":names",$names,PDO::PARAM_STR);
    $stmt->bindValue(":firstname",$firstname,PDO::PARAM_STR);
    $stmt->bindValue(":commune",$commune,PDO::PARAM_STR);
    $stmt->execute();
    $stmt->closeCursor();
    return true ;

}

function getAllElevesOfClasse($idclasse){
    $bdd = connexionPDO();
    $req = 'SELECT eleves.id, eleves.names, eleves.firstname, eleves.commune FROM eleves, elevesparclasse WHERE eleves.id = elevesparclasse.ideleve AND elevesparclasse.idclasse = :idclasse ORDER BY names, firstname' ;
    $stmt = $bdd -> prepare($req) ;
    $stmt->bindValue(":idclasse",$idclasse,PDO::PARAM_INT);
    $stmt->execute();
    $eleves = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    echo json_encode($eleves); 
    //return $eleves
    
}


function getAllElevesFromBdd(){
    $bdd = connexionPDO();
    $req = 'SELECT * FROM eleves ORDER BY names, firstname' ;
    $stmt = $bdd -> prepare($req) ;
    $stmt->execute();
    $eleves = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    if(isset($_GET['function']) && $_GET['function'] == 'getAllElevesFromBdd'){
        echo json_encode($eleves); 
    } else {
        return $eleves;
    }
}

function getAllElevesOfSection($idsection){
    $bdd = connexionPDO();
    $req = 'SELECT DISTINCT eleves.id, eleves.names, eleves.firstname, eleves.commune FROM eleves, elevesparclasse  WHERE eleves.id = elevesparclasse.ideleve AND elevesparclasse.idsection = :idsection GROUP BY names ORDER BY names, firstname' ;
    $stmt = $bdd -> prepare($req) ;
    $stmt->bindValue(":idsection",$idsection,PDO::PARAM_INT);
    $stmt->execute();
    $eleves = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    echo json_encode($eleves); 
}

function getIdEleve(){
    $names = $_GET['names'];
    if($_GET['firstname'] != "") {$firstname = $_GET['firstname'];} else {$firstname = "";}
    $bdd = connexionPDO();
    $req = 'SELECT eleves.id FROM eleves WHERE eleves.names = :names AND eleves.firstname = :firstname' ;
    $stmt = $bdd -> prepare($req) ;
    $stmt->bindValue(":names",$names,PDO::PARAM_STR);
    $stmt->bindValue(":firstname",$firstname,PDO::PARAM_STR);
    $stmt->execute();
    $ideleve = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    echo json_encode($ideleve); 
}

function saveEleveInClass(){
    
    $ideleve = intval($_POST['ideleve']);
    $idclasse = intval($_POST['idclasse']);
    $idsection = intval($_POST['idsection']);
    var_dump($_POST['idclasse']);
    var_dump($idclasse);
    $bdd = connexionPDO();
    $req = "INSERT INTO elevesparclasse (ideleve, idclasse, idsection) VALUES (:ideleve, :idclasse, :idsection)" ;
    $stmt = $bdd -> prepare($req) ;
    $stmt->bindValue(":ideleve",$ideleve,PDO::PARAM_INT);
    $stmt->bindValue(":idclasse",$idclasse,PDO::PARAM_INT);
    $stmt->bindValue(":idsection",$idsection,PDO::PARAM_INT);
    $stmt->execute();
    $stmt->closeCursor();
    return true ;
}

?>