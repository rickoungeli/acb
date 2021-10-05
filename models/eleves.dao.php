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
    $req = 'SELECT * FROM eleves' ;
    $stmt = $bdd -> prepare($req) ;
    $stmt->execute();
    $eleves = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    echo json_encode($eleves); 
}




?>