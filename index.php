<?php 
require_once("controllers/frontend.controller.php");

if(isset($_GET['page'])) {

    if($_GET['page'] === "accueil") getAccueil() ;
     
    if($_GET['page'] === "eleves") getEleves() ;

    if($_GET['page'] === "projet2022") getInscritsProjet2022() ;
}
else { 
    getAccueil(); 
}

?>