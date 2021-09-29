<?php 
session_start() ;
require_once("controllers/backend.controller.php");
require_once("controllers/frontend.controller.php");
require_once("config/Securite.class.php") ;

try {
    if(isset($_GET['page']) && !empty($_GET['page'])) {
        $page = Securite::secureHtml($_GET['page']) ;
        $page = $_GET['page'] ;
        switch ($page) {
            case "accueil" : getPageAccueil() ;
            break ;
            case "eleves" : getPageEleves() ;
            break ;
            case "membres" : getPageMembres() ;
            break ;
            case "projet2022" : getPageProjet2022() ;
            break ;
            case "login" : getPageLogin() ;
            break ;
            case "signup" : getPageSignup() ;
            break ;
            case "deconnexion" : getPageDeconnexion() ;
            break ;
            case "error301" :
            case "error302" :
            case "error400" :
            case "error401" :
            case "error402" :
            case "error405" :
            case "error500" :
            case "error505" : throw new Exception("Erreur de type : " . $page) ;
            break ;
            case "error403" : throw new Exception("L'access à ce dossier n'est pas autorisé") ;
            break ;
            case "error404" : throw new Exception("La page demandée n'a pas été trouvée Erreur 404") ;
            break ;
            default : throw new Exception("La page demandée n'existe pas") ;
        }
    }
    else { 
        getPageAccueil(); 
    }
} catch(Exception $e) {
    $title = "Erreur" ;
    $description = "Page de gestion des erreurs" ;
    $errorMessage = $e->getMessage() ;
    require "views/commons/erreur.views.php" ;
}

?>


