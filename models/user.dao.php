<?php
require_once("pdo.php");

function signupUser(){ //Fonction pour enregistrer un nouvel utilisateur
    if( isset($_POST['firstname']) && !empty($_POST['firstname']) &&
    isset($_POST['name']) && !empty($_POST['name']) &&
    isset($_POST['email']) && !empty($_POST['email']) &&
    isset($_POST['password']) && !empty($_POST['password']) &&
    isset($_POST['password-confirm']) && !empty($_POST['password-confirm'])
    ) {
        //Check des variables postées par l'utilisateur
        $firstname = securite::secureHTML($_POST['firstname']) ;
        $name = securite::secureHTML($_POST['name']) ;
        $email = securite::secureHTML($_POST['email']) ;
        $password = securite::secureHTML($_POST['password']) ;
        $passwordConfirm = securite::secureHTML($_POST['password-confirm']) ;
        $date = date("Y-m-d H:i:s", time()) ;

        //Indestion des données dans la bdd
        insertUserIntoBdd($firstname, $name, $email, $password, $passwordConfirm, $date) ;
    }
}

function insertUserIntoBdd($firstname, $name, $email, $password, $passwordConfirm, $date) {
    $bdd = connexionPDO();
    $req = "INSERT INTO users(firstname, name, email, password, date) 
            values (:firstname, :name, :email, :password, :date)" ;
    $stmt = $bdd -> prepare($req) ;
    $stmt->bindValue(":firstname",$firstname,PDO::PARAM_STR);
    $stmt->bindValue(":name",$name,PDO::PARAM_STR);
    $stmt->bindValue(":email",$email,PDO::PARAM_STR);
    $stmt->bindValue(":password",$password,PDO::PARAM_STR);
    $stmt->bindValue(":date",$date,PDO::PARAM_STR);
    $stmt->execute();
    $stmt->closeCursor();
}

function getUserFromBdd($email){
    $bdd = connexionPDO();
    $req = 'SELECT * FROM users WHERE email = :email' ;
    $stmt = $bdd -> prepare($req) ;
    $stmt->bindValue(":email",$email,PDO::PARAM_STR);
    $stmt->execute();
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
    return $admin ;
}

function isUserInBdd($email, $password){
    echo $email;
    echo $password;
    $admin = getUserFromBdd($email) ;
    //$passwordHash = getUserFromBdd($email) ;
    echo $admin['password'];
    if(password_verify($password,$admin['password'])){
        echo "Mot de passe correct";
        return true ;
    } else {
        echo "Mot de passe incorrect";
        return false ;
    }
}


?>