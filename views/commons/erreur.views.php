<?php
ob_start();
$titre1 = "ERREUR";
?>

<div class="alert alert-danger mt-3" role="alert">
    <?= $errorMessage ?>
</div>


<?php
$content = ob_get_clean();
require "views/commons/template.php";
?>