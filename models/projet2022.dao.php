<?php
require_once("pdo.php");

function getMembersFromProjet2022(){
    $bdd = connexionPDO();
    $req = 'SELECT * FROM inscritsprojet2022, users WHERE inscritsprojet2022.user_id = users.id ORDER BY name, firstname' ;
    $stmt = $bdd -> prepare($req) ;
    $stmt->execute();
    $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //$resultat = $stmt->fetchAll();
    $stmt->closeCursor();
    return $resultat ;
}



?>

