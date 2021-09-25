<?php 
ob_start();
$titre1 = "PROJET 2022";
?>

<div class="d-flex flew-row justify-content-between mx-2 my-1">
    <h2 class="align-middle">Liste des inscrits</h2>
    <button class="btn btn-primary">Adhérer au projet</button>
</div>
<table class="table table-bordered table-striped w-100 ">
    <thead>
        <tr class="text-center bg-info text-light">
            <th width="5%">id</th>
            <th width="30%">Nom</th>
            <th width="20%">Prénom</th>
            <th width="30%">Pays</th>
            <th width="15%">Inscrit le</th>
        </tr>
    </thead>
    <tbody>
        <?php
        //$result = "";
        foreach($inscrits as $result) {
            echo "<tr>" ;
            echo "<td width='5%' class='text-end'>".$result['id']."</td>" ;
            echo "<td width='30%'>".$result['name']."</td>" ;
            echo "<td width='20%'>".$result['firstname']."</td>" ;
            echo "<td width='30%'>".$result['country']."</td>" ;
            echo "<td width='15%'>".$result['date']."</td>" ;
            echo "</tr>" ;
        }
        ?>
    </tbody>
</table>

<?php 
$content = ob_get_clean() ;
require "./views/commons/template.php" ;
?>