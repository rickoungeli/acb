<?php
ob_start();
$titre1 = "";
?>

<?php
//session_start();
$titre1 = "LISTE DES ACB92 / CLASSE";
$title = "Liste des élèves du Collège Boboto de la promotion 1992" ;
$description = "Cette page reconstitue les listes des Anciens Elèves du Collège Boboto de la promotion 1992, en sigle ACB92, insi que leurs différentes classes";
?>

<div class="alert alert-danger text-center mt-5">
    <h2 class="text-center"> CE SITE EST EN CONSTRUCTION</h2>
    <h3 class="text-center">AUCUN ELEVE N'EST ENREGISTRE</h3>
</div>
<h2 class="mt-3"></h2>


<?php
$content = ob_get_clean();
require "views/commons/template.php";
?>