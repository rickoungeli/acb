<?php 
const HOST_NAME = "nsxuijracb92.mysql.db";
const DATABASE_NAME = "nsxuijracb92";
const USER_NAME = "nsxuijracb92";
const PASSWORD = "Le29011974";
//require_once("../config/config.php");
require_once("pdo.php");

//if(isset($_GET['function']) && !empty($_GET['function'])){
    $function = $_GET['function'] ;
    switch ($function) {
        case "getElevesByClassFromBdd" : 
            $idclasse = $_GET['idclasse'];
            getElevesByClassFromBdd($idclasse) ;
            break ;
        case "getAllElevesFromBdd" : getAllElevesFromBdd() ;
            break ;
        case "createNewEleve" : createNewEleve() ;
            break ;
        case "saveEleveInClass" : saveEleveInClass() ;
            break ;
        case "getIdEleve" : getIdEleve() ;
            break ;
    }
//}

function getElevesByClassFromBdd($idclasse){
    $bdd = connexionPDO();
    $req = 'SELECT eleves.id, eleves.names, eleves.firstname, eleves.commune FROM eleves, elevesparclasse WHERE eleves.id = elevesparclasse.id_eleve AND elevesparclasse.id_classe = :idclasse ORDER BY names, firstname' ;
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
    echo json_encode($eleves); 
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

function saveEleveInClass(){
    $ideleve = $_POST['ideleve'];
    $idclasse = $_POST['idclasse'];
    $bdd = connexionPDO();
    $req = "INSERT INTO elevesparclasse (id_classe, id_eleve) VALUES (:idclasse, :ideleve)" ;
    $stmt = $bdd -> prepare($req) ;
    $stmt->bindValue(":idclasse",$idclasse,PDO::PARAM_INT);
    $stmt->bindValue(":ideleve",$ideleve,PDO::PARAM_INT);
    $stmt->execute();
    $stmt->closeCursor();
    return true ;
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

?>