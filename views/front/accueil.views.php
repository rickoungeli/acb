<?php
ob_start();
$titre1 = "BIEVENUE SUR LE SITE DES ACB 1992";
?>

<div class="alert alert-danger mt-6">
    <h2 class="text-center">CE SITE EST EN CONSTRUCTION</h2>
    <h3 class="text-center">CE SITE EST EN CONSTRUCTION</h3>
</div>

<?php
$content = ob_get_clean();
require "views/template.php";
?>