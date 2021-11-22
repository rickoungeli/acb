<?php
session_start();

const HOST_NAME = "nsxuijracb92.mysql.db";
const DATABASE_NAME = "nsxuijracb92";
const USER_NAME = "nsxuijracb92";
const PASSWORD = "Le29011974";
//require_once("../config/config.php");
require_once("pdo.php");

$function = $_GET['function'] ;
switch ($function) {
    case "insertPropositionOfActivite" : insertPropositionOfActivite() ;
        break ;
    case "getAllPropositionsOfActivityFromBdd" : getAllPropositionsOfActivityFromBdd();
        break;
    case "addNotification" : insertNotificationIntoBdd();
    break;
}


function getOneMemberFromProjet2022($id){
    $bdd = connexionPDO();
    $req = 'SELECT * FROM inscrits_projet2022 WHERE id_user = :id' ;
    $stmt = $bdd -> prepare($req) ;
    $stmt->bindValue(":id",$id,PDO::PARAM_INT);
    $stmt->execute();
    $member = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $member ;
}

function getAllMembersFromProjet2022(){
    $bdd = connexionPDO();
    $req = "SELECT users.id AS id, users.firstname AS userfirstname, users.name AS username, users.country AS country, inscrits_projet2022.date_inscription AS dateinsc FROM users, inscrits_projet2022 WHERE users.id = inscrits_projet2022.id_user ORDER BY username, userfirstname" ;
    $stmt = $bdd -> prepare($req) ;
    $stmt->execute();
    $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $resultat ;
}

function insertMembersToProjet2022($id){
    $bdd = connexionPDO();
    $req = "INSERT INTO inscrits_projet2022(id_user) VALUES (:id)" ;
    $stmt = $bdd -> prepare($req) ;
    $stmt->bindValue(":id",$id);
    $stmt->execute();
    $stmt->closeCursor();
    return true ;
}

function insertPropositionOfActivite(){
    //On récupère les données envoyées par l'utilisateur
    $auteur = $_SESSION['id'];
    $secteur = $_POST['secteur'];
    $libelle = $_POST['libelle'];
    if($_POST['comment'] != "") {$comment = $_POST['comment'];} else {$comment = "";}

    //On enregistre l'activité dans la bdd
    $bdd = connexionPDO();
    $req = "INSERT INTO activites (secteur, libelle, comment, auteur) VALUES (:secteur, :libelle, :comment, :auteur)" ;
    $stmt = $bdd -> prepare($req) ;
    $stmt->bindValue(":secteur",$secteur,PDO::PARAM_STR);
    $stmt->bindValue(":libelle",$libelle,PDO::PARAM_STR);
    $stmt->bindValue(":comment",$comment,PDO::PARAM_STR);
    $stmt->bindValue(":auteur",$auteur);
    $stmt->execute();
    $stmt->closeCursor();
    return true ;
    
}

function getAllPropositionsOfActivityFromBdd(){
    $bdd = connexionPDO();
    $req = "SELECT users.name AS auteur, activites.id AS idactivite, activites.secteur AS secteur, activites.libelle AS libelle, activites.comment AS comment, activites.date_cre AS date_cre  FROM activites, users WHERE activites.auteur = users.id ORDER BY date_cre DESC" ;
    $stmt = $bdd -> prepare($req) ;
    $stmt->execute();
    $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    if(isset($_GET['function']) && $_GET['function'] == 'getAllPropositionsOfActivityFromBdd'){
        echo json_encode($resultat); 
    } else {
        return $resultat;
    }
}

function insertNotificationIntoBdd(){
    //On récupère les données envoyées par l'utilisateur
    $libelle = $_POST['message'];
    $iduser = $_SESSION['id'];

    //On enregistre la notification dans la bdd
    $bdd = connexionPDO();
    $req = "INSERT INTO notifications (libelle, iduser) VALUES (:libelle, :iduser)" ;
    $stmt = $bdd -> prepare($req) ;
    $stmt->bindValue(":libelle",$libelle,PDO::PARAM_STR);
    $stmt->bindValue(":iduser",$iduser,PDO::PARAM_INT);
    $stmt->execute();
    $stmt->closeCursor();
    return true ;
}


?>