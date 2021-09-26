<?php 
ob_start();
$titre1 = "PROJET 2022";
?>

<?php if($alert !== "") { echo "<div class='alert alert-danger my-0' role='alert'>" . $alert . "</div>";  } ?>
<form action="" method="POST" class="d-flex flew-row justify-content-between mx-2 my-1">
    <h2 class="align-middle">Liste des inscrits</h2>
    <input type="text" name="id_user" class="d-none"/>
    <input type="submit" class="btn btn-primary" value="Adhérer au projet" />
</form>
<table class="table table-bordered table-striped w-100 ">
    <thead>
        <tr class="text-center bg-info text-light">
            <th width="5%">N°</th>
            <th width="30%">Nom</th>
            <th width="20%">Prénom</th>
            <th width="30%">Pays</th>
            <th width="15%">Inscrit le</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $inscrits = getAllMembersFromProjet2022();
        $i=1;
        echo "Nombre d'inscrits : ". count($inscrits);
        foreach($inscrits as $inscrit) {
            echo "<tr>" ;
            echo "<td width='5%' class='text-end'>".$i."</td>" ;
            echo "<td width='30%'>".$inscrit['username']."</td>" ;
            echo "<td width='20%'>".$inscrit['userfirstname']."</td>" ;
            echo "<td width='30%'>".$inscrit['country']."</td>" ;
            echo "<td width='15%'>".getdate($inscrit['dateinsc'])."</td>" ;
            echo "</tr>" ;
            $i++;
        }
        ?>
    </tbody>
</table>

<?php 
$content = ob_get_clean() ;
require "./views/commons/template.php" ;
?>