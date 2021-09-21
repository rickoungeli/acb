<?php 
    require_once("config/config.php");

    function getPageAccueil(){
        $title = "Bienvenue sur le site des ACB 1992" ;
        $description = "Cette page est la page d'accueil du site des Anciens Elèves du Collège Boboto de la promotion 1992, en sigle ACB92";
        require_once("views/front/accueil.views.php") ;
    }

    function getPageEleves(){
        $title = "Liste des élèves du Collège Boboto de la promotion 1992" ;
        $description = "Cette page reconstitue les listes des Anciens Elèves du Collège Boboto de la promotion 1992, en sigle ACB92, insi que leurs différentes classes";
        require_once("views/front/eleves.views.php") ;
    }

    function getPageProjet2022() {
        if(Securite::verificationAccess()){
            require_once("models/projet2022.dao.php");
            $title = "Projet 2022" ;
            $description = "Cette page est la page d'informations pour les membres participants au projet de création d'une entreprise par les Anciens du Collège Boboto de la promotion 1992";
            $inscrits = getMembersFromProjet2022() ;
            require_once("views/front/projet2022.views.php") ;
        } else {
            throw new Exception("L'accès à cette page est réservé aux membres inscriits au projet2022");
            require_once("views/front/error.views.php") ;
        }
    }


?>

