<?php 
    require("models/user.dao.php") ;
    require_once("config/config.php");


    function getPageLogin(){
        $title = "Page de connexion" ;
        $description = "Page de login";
        if(Securite::verificationAccess() && Securite::verificationCookie()) { header ("Location: accueil") ;} 
        
        $alert = "";

        if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])) {
            $email = Securite::secureHtml($_POST['email']) ;
            $password = Securite::secureHtml($_POST['password']) ;
            //On vérifie si cet utilisateur est enregistré
            if(isUserInBdd($email, $password)){
                $_SESSION['access'] = 'admin' ;
                Securite::genereCookiePassword();
                header ("Location: accueil") ;
            } else {
                $alert = "Mot de passe invalide" ;
            }
        }
        require_once("views/front/login.views.php") ;
    }

    function getPageSignup(){
        require_once("models/projet2022.dao.php");
        $title = "Page d'inscription" ;
        $description = "";
        signupUser();
        require_once("views/front/signup.views.php") ;
    }
?>