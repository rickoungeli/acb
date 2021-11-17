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
            $email = securite::secureHTML($_POST['email']) ;
            $user = getOneUserFromBdd($_POST['email']);
            if($user == true) { 
                $ctrl = 1;
                sendEmail($email);
            } else {
                $ctrl = 0;          
            } 
        } 
        require_once("views/front/users/getpassword.views.php") ; 
    }

    function sendEmail($email){
        require('PHPMailer/PHPMailerAutoload.php');
        $token = 'fdryuopmknbcwqazertg';
        //$mail = new PHPMailer();

        $mail ->isSMTP();
        $mail->Host='ssl0.ovh.net';
        $mail->SMTPAuth = true;
        $mail->Username='admin@acb92.com';
        $mail->Password='123456789';
        $mail->SMTPSecure ='tls';
        $mail->Port=465;

        $mail->setFrom('rickoungeli@gmail.com', 'ACB92.COM');
        $mail->addAddress($email);

        $mail->isHTML(true);
        echo "bonjour";
        $mail->Subject='Réinitialisation mot de passe';
        $mail->Body = "Afin de réinitialiser votre adresse mot de passe, merci de cliquer sur le lien suivant: 
        <a href='https://www.acb92.com/views/front/users/new_password.view.php?token='".$token."'&email='".$email."'>Réinitialiser mot de passe</a>";

        if(!$mail->send()){
            echo "Mail non envoyé";
            echo 'Erreurs:'.$mail->ErrorInfo;
        }else{
            echo "Votre email a bien été envoyé";
        }
    }
?>