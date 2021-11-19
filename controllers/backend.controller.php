<?php 
    require_once("config/config.php");
    require("models/user.dao.php") ;



    function getPageLogin(){
        $title = "Page de connexion" ;
        $description = "Page de login"; 
        if(Securite::verificationAccess() && Securite::verificationCookie()) { header ("Location: accueil") ;} 
        
        $alert = "";

        if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password'])) {
            //On récupère les données envoyées par l'utilisateur
            $email = Securite::secureHtml($_POST['email']) ;
            $password = Securite::secureHtml($_POST['password']) ;

            //On vérifie si l'utilisateur a coché se souvenir de moi pour créer ou non des cookies
            if(isset($_POST['remember-checkbox'])){
                //if(isset($_COOKIE['email']) && $_COOKIE['email'] != $email && isset($_COOKIE['password']) && $_COOKIE['password'] != $password){
                    setcookie('email', $email, time()+30*24*3600);
                    setcookie('password', $password,  time()+3000*24*3600);
                //}
            } else {
                if(isset($_COOKIE['email']) && isset($_COOKIE['password'])){
                    setcookie('email', "");
                    setcookie('password', "");
                }
            }

            //On vérifie si cet utilisateur est enregistré dans la bdd
            $user = getOneUserFromBdd($email) ;
            
            if($user){
                //if(password_verify($password,$user['password'])){
                $hash = md5($password);
                if($hash == $user['password']){
                    echo "Email et Mot de passe corrects ";
                    $_SESSION['user'] = 'connecté' ;
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['name'] = $user['name'];
                    Securite::genereCookiePassword();
                    header ("Location: accueil") ;
                } else {
                    $alert = "Mot de passe incorrect " ; 
                    require_once("views/front/login.views.php") ;
                }
            } else {
                $alert = "L'email est incorrect" ;
                require_once("views/front/login.views.php") ;
            }
        } 
        require_once("views/front/login.views.php") ;
    }

    function getPageSignup(){
        $title = "Page d'inscription" ;
        $description = "";
        if(Securite::verificationAccess() && Securite::verificationCookie()) { header ("Location: accueil") ;} 
        $alert = "";
        $alert1 = "";

        if( isset($_POST['firstname']) && !empty($_POST['firstname']) &&
        isset($_POST['name']) && !empty($_POST['name']) &&
        isset($_POST['email']) && !empty($_POST['email']) &&
        isset($_POST['password']) && !empty($_POST['password']) &&
        isset($_POST['password-confirm']) && !empty($_POST['password-confirm'])
        ) {
            //Check des variables postées par l'utilisateur
            $firstname = securite::secureHTML($_POST['firstname']) ;
            $name = strtoupper(securite::secureHTML($_POST['name'])) ;
            $email = securite::secureHTML($_POST['email']) ;
            $password = securite::secureHTML($_POST['password']) ;
            $passwordConfirm = securite::secureHTML($_POST['password-confirm']) ;
            $country = securite::secureHTML($_POST['country']) ;
            $phone = securite::secureHTML($_POST['phone']) ;
            $date = date("Y-m-d H:i:s", time()) ;
            if(getOneUserFromBdd($email)){
                $alert = "Un compte utilise déja cet email" ;
            }
            else {
                
                if($password === $passwordConfirm){
                    //$hash = password_hash($password, PASSWORD_DEFAULT);
                    $hash = md5($password);
                    //Insettion des données dans la bdd
                    try{
                        insertUserIntoBdd($firstname, $name, $email, $hash, $date, $country, $phone) ;
                        $alert1 = "Vous avez été enregistré avec succès" ;
                        $_POST['firstname']=$_POST['name']=$_POST['password']=$_POST['email']=$_POST['phone']=$_POST['country']="";
                        //header ("Location: login.views.php") ;
                    } 
                    catch(Exception $e) {
                        $alert = "Un problème est survenu" ;
                    }
                } else {
                    $alert = "Les mots de passe ne correspondent pas" ;
                }
            }
        }
        require_once("views/front/signup.views.php") ;
    }

    function getPageMembres(){
        if(Securite::verificationAccess()){
            $title = "Liste des membres" ;
            $description = "Cette page affiche la liste de tous les Anciens du Collège Boboto de la Promotion 1980-1992";
            $membres = getAllUsersFromBdd() ;
            $ctrl = 0;
            require_once("views/front/membres.views.php") ;
        } else {
            throw new Exception("Veuiller vous connecter pour accéder à cette page");
            require_once("views/front/error.views.php") ;
        }
    }

    function getPagePasswordForget(){
        $title = "Mot de passe oublié" ;
        $description = "Page de récupération du mot de passe";
        $alert = "";
        $alert1 = "";
        
        if( isset($_POST['email']) && !empty($_POST['email'])){
            $destinataire = securite::secureHTML($_POST['email']) ;
            $user = getOneUserFromBdd($_POST['email']);
            if($user) { 
                $alert1="Votre demande a été prise en compte";
                sendEmail($destinataire);
            } else {
                $alert ="L'email est incorrect";          
            } 
        } 
        require_once("views/front/users/getpassword.views.php") ; 
    }

    function getPageNewPassword(){
        $title = "Nouveau mot de passe" ;
        $description = "Page de création du nouveau mot de passe";
        $alert = "";
        $alert1 = "";
        
        if( isset($_POST['passwordnew']) && !empty($_POST['passwordnew']) && isset($_POST['passwordconfirm']) && !empty($_POST['passwordconfirm'])){
            $passwordnew = securite::secureHTML($_POST['passwordnew']) ;
            $passwordconfirm = securite::secureHTML($_POST['passwordconfirm']) ;
            //Affichage de la page de création du nouveau mot de passe
            $alert1 = "";
            $alert = "Cette fonctionnalité n'est pas encore disponible";
        }
        require_once("views/front/users/new_password.views.php");
        
    }

    function sendEmail($destinataire){
        $objet = "Réinitialisation mot de passe";
        $token = 'fdryuopmknbcwqazertg';
        $message = "Afin de réinitialiser votre mot de passe, merci de cliquer sur le lien suivant: ";
        $message .= "https://www.acb92.com/new_password?token=".$token."&email=".$destinataire.">";
        $entetes = '';
        $entetes .= "From: \"Admin\" <admin@acb92.com>\r\n";
        $entetes .= "Reply-To: \"Contact\" <contact@acb92.com>\r\n";
        $entetes .= "X-Priority: l\r\n";
        if ($ok = mail($destinataire,$objet, $message, $entetes)) {
            header ("Location: views/front/users/mailing_confirm.views.php") ;
            
        };
        //echo $ok;
        
    }
?>