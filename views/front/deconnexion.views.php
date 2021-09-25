<?php
ob_start();
$titre1 = "DECONNEXION";
?>

<div class="alert alert-danger mt-3 text-center" role="alert">
    <?= $errorMessage ?>
</div>


<?php
$content = ob_get_clean();
require "views/commons/template.php";
?>