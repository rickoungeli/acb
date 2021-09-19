<?php 
    require_once("config/config.php");

    function getAccueil(){
        $title = "Bienvenue sur le site des ACB 1992" ;
        $description = "Cette page est la page d'accueil du site des Anciens Elèves du Collège Boboto de la promotion 1992, en sigle ACB92";
        require_once("views/front/accueil.views.php") ;
    }

    function getEleves(){
        $title = "Liste des élèves du Collège Boboto de la promotion 1992" ;
        $description = "Cette page reconstitue les listes des Anciens Elèves du Collège Boboto de la promotion 1992, en sigle ACB92, insi que leurs différentes classes";
        require_once("views/front/eleves.views.php") ;
    }

    function getInscritsProjet2022() {
        require_once("models/projet2022.dao.php");
        $title = "Projet 2022" ;
        $description = "Cette page est la page d'informations pour les membres participants au projet de création d'une entreprise par les Anciens du Collège Boboto de la promotion 1992";
        $inscrits = getMembersFromProjet2022() ;
        require_once("views/front/projet2020.views.php") ;
    }
?>