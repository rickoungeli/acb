<?php
ob_start();
$titre1 = "LISTE DES ELEVES";
?>

<form name="select-form"  class="form rounded mb-1 w-100 ms-auto border border-secondary">
    <div class="row no-gutters p-1">
        <div class="form-group col-6 mb-1 d-flex flex-column mx-auto">
            <label for="sections">Sections :</label>
            <select name="sections" id="sections" class="rounded ">
                <option value="#" selected="selected">Toutes</option>
                <?
                $sections = getAllSectionsFromBdd();
                foreach($sections as $section) {
                    
                    if(isset($_POST['sections']) && $_POST['sections']==$section['id']) {
                        echo "<option value='".$section['id']."' selected='selected'>".$section['nom']." </option>";
                    } else {
                        echo "<option value='".$section['id']."' >".$section['nom']." </option>";
                    }
                }
                ?>
            </select>
        </div>
        
        <div id="form-group-classe" class="form-group col-6 mb-1 d-flex flex-column mx-auto">
            <label for="sections">Classes :</label>
            <select name="classes" id="classes" class="rounded">
                <option value="#" selected="selected" >Toutes</option>
            </select>
        </div>
    </div>
    <div id="btn-add-eleve" class="col-12 text-center mb-1">
        <button class="btn btn-primary" id="btn1">Ajouter un élève</button>
    </div>
    
</form>
<?php $eleves = getAllElevesFromBdd(); ?>
<div class='d-none'>Nombre d'élèves : <?echo count($eleves) ?></div>
<table class="table table-bordered table-striped w-100">
    <thead>
        <tr class="text-center bg-info text-light">
            <th width="5%">N°</th>
            <th width="30%">Nom</th>
            <th width="20%"classes>Prénom</th>
            <th width="20%"classes>Commune</th>
        </tr>
    </thead>
    
    <tbody id="listOfEleves">
        <?php
        $i=1;
        foreach($eleves as $eleve) {
            echo "<tr>" ;
            echo "<td width='5%' class='text-end'>".($i)."</td>" ;
            echo "<td width='30%'>".$eleve['names']."</td>" ;
            echo "<td width='20%'>".$eleve['firstname']."</td>" ;
            echo "<td width='20%'>".$eleve['commune']."</td>" ;
            echo "<td class='d-none'>".$eleve['id']."</td>" ;
            echo "</tr>" ;
            $i++;
        }
        
        ?>
    </tbody>
</table>

<!-- Add new eleve in  class -->
<div id="overlay" class="d-none">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-primary">Ajout d'une élève</h5>
                <button type="button" class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form class="row no-gutters py-1 mb-0 scroller">
                    <div class="form-group col-12 ">
                        <input type="text" name="id" id="id"  class="form-control w-100 text-danger d-none">
                    </div>
                    <div class="form-group col-12">
                        <label for="names">Noms de l'élève :</label>
                        <input type="text" name="names" id="names" placeholder="Taper un nom ou sélectionner dans la liste"  class="form-control w-100 text-danger">
                    </div>
                    <div class="form-group mb-1 col-12 " id="form-group1">
                        <label for="firstname">Prénom de l'élève</label>
                        <input type="text" name="firstname" id="firstname"  class="form-control w-100 text-danger">
                    </div>
                    <div class="form-group mb-1 col-12 " id="form-group2">
                        <label for="commune">Commune où il vivait</label>
                        <input type="text" name="commune" id="commune"  class="form-control w-100 text-danger">
                    </div>
                    <div class="col-12 text-center mb-1 " id="form-group3">
                        <button class="btn btn-primary" >Enregistrer</button>
                    </div>
                    <div class="form-group col-12 border border-dark " id="autocom-box">
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require "views/commons/template.php";
?>