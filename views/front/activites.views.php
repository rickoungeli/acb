<?php 
ob_start();
$titre1 = "";
?>

<?php if($alert !== "") { echo "<div class='alert alert-danger my-0' role='alert'>" . $alert . "</div>";  } ?>
<form action="" method="POST" class="d-flex flew-row justify-content-between mx-2 my-1">
    <h2 class="align-middle">Activités proposées</h2>
    <input type="text" name="id_user" class="d-none"/>
    <a href="#" class="btn btn-primary" id="btn-show-overlay-add-activite">Proposer une activité" </a>
</form>
<!-- Overlay ajout d'une activité -->

<div id="overlay" class="d-none overlay-add-activite">
    <div class="modal-dialog ">
        <div class="modal-content bg-info">
            <div class="modal-header">
                <h5 class="modal-title text-primary">Proposition d'une activité</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4>PROPOSITION D'ACTIVITES</h2>
                <form class="row no-gutters form py-1 mb-0">

                    <div id="form-group-classe" class="form-group col-12 mb-1 d-flex flex-column mx-auto">
                        <label for="secteurs" class="form-label text-dark">Secteurs d'activité :</label>
                        <select name="secteurs" id="secteurs" class="form-select rounded">
                            <option value="#" selected="selected" >Sélectionner une secteur</option>
                            <option value="1">Production</option>
                            <option value="2">Service</option>
                            <option value="3">Transformation</option>
                        </select>
                    </div>

                    <div class="form-group mb-1 col-12" id="form-group1">
                        <label for="activite"  class="form-label text-dark">Désignation de l'activité </label>
                        <input type="text" name="activite" id="activite"  class="form-control w-100 text-danger" placeholder="Nom de l'activité">
                    </div>

                    <div class="form-group mb-1 col-12 d-flex flex-column" id="form-group2">
                        <label for="commentaire"  class="form-label text-dark">Votre Commentaire</label>
                        <textarea class="form-control" name="commentaire" id="commentaire" cols="30" rows="10"></textarea>
                    </div>
                    <div class="col-12 text-center mb-1 ">
                        <button class="btn btn-danger" id="btn-close-overlay">Annuler</button>
                        <button class="btn btn-primary disabled" id="save-proposition-activites">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<table class="table table-bordered table-striped w-100 ">
    <thead>
        <tr class="text-center bg-info text-light">
            <th width="5%">N°</th>
            <th width="30%">Nom</th>
            <th width="20%">Activité proposée</th>
            <th width="45%">Commentaire</th>
            <th width="15%"></th>
        </tr>
    </thead>
    <tbody>
        <?php
            
        /*
        $propositions = getAllPropositionsOfActivityFromBdd();
        $i=1;
        echo "Nombre de propositions : ". count($propositions);
        foreach($propositions as $proposition) {
            echo "<tr>" ;
            echo "<td width='5%' class='text-end'>".$i."</td>" ;
            echo "<td width='30%'>".$proposition['name']."</td>" ;
            echo "<td width='20%'>".$proposition['']."</td>" ;
            echo "<td width='30%'>".$proposition['']."</td>" ;
            echo "</tr>" ;
            $i++;
        }

        */
        ?>
    </tbody>
</table>

<div class='alert alert-danger my-4 text-center' role='alert'> Cette fonctionnalité n est pas encore disponible</div>

<?php 
$content = ob_get_clean() ;
require "./views/commons/template.php" ;
?>