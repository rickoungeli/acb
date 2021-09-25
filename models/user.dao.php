<?php
require_once("pdo.php");


function insertUserIntoBdd($firstname, $name, $email, $password, $date) {
    $bdd = connexionPDO();
    $req = "INSERT INTO users(firstname, name, email, password, date) VALUES (:firstname, :name, :email, :password, :date)" ;
    $stmt = $bdd -> prepare($req) ;
    $stmt->bindValue(":firstname",$firstname,PDO::PARAM_STR);
    $stmt->bindValue(":name",$name,PDO::PARAM_STR);
    $stmt->bindValue(":email",$email,PDO::PARAM_STR);
    $stmt->bindValue(":password",$password,PDO::PARAM_STR);
    $stmt->bindValue(":date",$date,PDO::PARAM_STR);
    $stmt->execute();
    $stmt->closeCursor();
}

//Fonction pour récupérer tous les utilisateurs
function getAllUsersFromBdd(){
    $bdd = connexionPDO();
    $req = 'SELECT * FROM users' ;
    $stmt = $bdd -> prepare($req) ;
    $stmt->execute();
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $users ;  
}

//Fonction pour chercher un utilisateur par son email
function getOneUserFromBdd($email){
    $bdd = connexionPDO();
    $req = 'SELECT * FROM users WHERE email = :email' ;
    $stmt = $bdd -> prepare($req) ;
    $stmt->bindValue(":email",$email,PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $user ;
}

?>