<?php 
ob_start();
$titre1 = "LISTE DES MEMBRES";
?>

<table class="table table-bordered table-striped w-100 ">
    <thead>
        <tr class="text-center bg-info text-light">
            <th width="5%">id</th>
            <th width="30%">Nom</th>
            <th width="20%">Prénom</th>
            <th width="30%">Pays de résidence</th>
            <th width="15%">Observations</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $membres = getAllUsersFromBdd();
        $i=1;
        foreach($membres as $membre) {
            echo "<tr>" ;
            echo "<td width='5%' class='text-end'>".($i)."</td>" ;
            echo "<td width='30%'>".$membre['name']."</td>" ;
            echo "<td width='20%'>".$membre['firstname']."</td>" ;
            echo "<td width='30%'>".$membre['country']."</td>" ;
            echo "<td width='15%'>".$membre['observ']."</td>" ;
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