<?php
ob_start();
$titre1 = "LISTE DES ELEVES";
?>

<h3 class='alert alert-danger my-0 mt-3 text-center' role='alert'> Aucun élève n'est enregistré</h3>
<form action="" method="POST"  class="form row no-gutters border border-secondary p-1  rounded mb-1 w-100 ms-auto d-none">
    <select name="sections" id="sections" class="col-12 col-sm-5 mb-1 me-1">
        <option value="#" selected="selected">Sections</option>
        <?php
        $sections = getAllSectionsFromBdd();
        foreach($sections as $section) {
            echo "<option value=".$section['id'].">".$section['nom']."</option>";
        }
        ?>
    </select>

    <select name="classes" id="" class="col-12 col-sm-5 mb-1 me-1">

    </select>
    
    <input type="submit" value="Ok" class="col-12 col-sm-1 ">
</form>

<table class="table table-bordered table-striped w-100 d-none">
    <thead>
        <tr class="text-center bg-info text-light">
            <th width="5%">N°</th>
            <th width="30%">Nom</th>
            <th width="20%"classes>Prénom</th>
            <th width="20%"classes>Commune</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $eleves = getAllElevesFromBdd();
        $i=1;
        foreach($eleves as $eleve) {
            echo "<tr>" ;
            echo "<td width='5%' class='text-end'>".$i."</td>" ;
            echo "<td width='30%'>".$eleve['noms']."</td>" ;
            echo "<td width='20%'>".$eleve['prenom']."</td>" ;
            echo "<td width='30%'>".$eleve['commune']."</td>" ;
            echo "</tr>" ;
            $i++;
        }
        
        ?>
    </tbody>
</table>


<?php
$content = ob_get_clean();
require "views/commons/template.php";
?>