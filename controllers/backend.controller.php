<?php 
    require_once("config/config.php");
    require("models/user.dao.php") ;



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
                header ("Location: accueil.views.php") ;
            } else {
                $alert = "Mot de passe invalide" ;
            }
        }
        require_once("views/front/login.views.php") ;
    }

    function getPageSignup(){
        $title = "Page d'inscription" ;
        $description = "";
        $alert = "";
        $alert1 = "";
        //signupUser();
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
            
            if(getUserFromBdd($email)){
                $alert = "Un compte utilise déja cet email" ;
            }
            else {
                
                if($password === $passwordConfirm){

                    //$hash = password_hash($password, PASSWORD_DEFAULT);
                    //echo $hash;
                    //Insettion des données dans la bdd
                    insertUserIntoBdd($firstname, $name, $email, $password, $date) ;
                    $alert1 = "Vous avez été enregistré avec succès" ;
                    $_POST['firstname']=$_POST['name']=$_POST['password']="";
                    echo "données enregistrées";
                    header ("Location: login.views.php") ;
                } else {
                    $alert = "Les mots de passe ne correspondent pas" ;
                }
            }
        }
        require_once("views/front/signup.views.php") ;
    }

    function getPageMembres(){
        $title = "Liste des membres" ;
        $description = "Cette page affiche la liste de tous les Anciens du Collège Boboto de la Promotion 1980-1992";
        $membres = getAllUsersFromBdd() ;

        require_once("views/front/membres.views.php") ;
    }

?>