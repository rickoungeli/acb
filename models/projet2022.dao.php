<?php
require_once("pdo.php");

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

?>