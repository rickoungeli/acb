<?php 
    require_once("config/config.php");
    require_once("models/eleves.dao.php");
    require_once("models/sections.dao.php");
    require_once("models/projet2022.dao.php");
    
    function getPageAccueil(){
        $title = "BIEVENUE SUR LE SITE DES ACB 1992" ;
        $description = "Cette page est la page d'accueil du site des Anciens Elèves du Collège Boboto de la promotion 1992, en sigle ACB92";
        require_once("views/front/accueil.views.php") ;
    }

    function getPageEleves(){
        $title = "Liste des élèves du Collège Boboto de la promotion 1992" ;
        $description = "Cette page reconstitue les listes des Anciens Elèves du Collège Boboto de la promotion 1992, en sigle ACB92, insi que leurs différentes classes";
        require_once("views/front/eleves.views.php") ;
    }

    function getPageProjet2022() {
        $alert = "";
        if(Securite::verificationAccess()){
            //Si l'utilisateur a cliqué pour s'inscrire
            if(isset($_POST['id_user'])){
                $id = $_SESSION['id'];
                //On vérifie si cet utilisateur est déjà inscrit
                $user=getOneMemberFromProjet2022($id);
                if($user){
                    $alert = "Vous êtes déjà inscrit à ce projet";
                } else {
                    if(insertMembersToProjet2022($id)){
                        require_once("views/front/projet2022.views.php") ;
                    }
                    else {
                        $errorMessage = "Un problème est survenu";
                        require_once("views/common/erreur.views.php") ;
                    }
                }
            }
            $title = "Projet 2022" ;
            $description = "Cette page est la page d'informations pour les membres participants au projet de création d'une entreprise par les Anciens du Collège Boboto de la promotion 1992";
            require_once("views/front/projet2022.views.php") ;
        } else {
            throw new Exception("Veuiller vous connecter pour accéder à cette page");
            require_once("views/front/error.views.php") ;
        }
    }

    function getPageDeconnexion(){
        session_unset();
        session_destroy();
        $errorMessage = "Vous êtes déconnecté";
        require_once("views/front/deconnexion.views.php") ;
    }

?>

