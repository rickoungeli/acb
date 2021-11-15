<?php 
ob_start();
$titre1 = "PROPOSITIONS D'ACTIVITES";
?>

<?php if($alert !== "") { echo "<div class='alert alert-danger my-0' role='alert'>" . $alert . "</div>";  } ?>
<form action="" method="POST" class="d-flex flew-row justify-content-between mx-2 my-1">
    <h2 class="align-middle">Activités proposées</h2>
    <input type="text" name="id_user" class="d-none"/>
    <a href="#" class="btn btn-primary" >Proposer une activité" </a>
</form>
<!-- Add new eleve in  class -->
<div id="overlay" class="">
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
                        <label for="secteur">Secteur d'activité :</label>
                        <input type="text" name="secteur" id="secteur" placeholder="Taper un secteur d'activité"  class="form-control w-100 text-danger">
                    </div>
                    <div class="form-group mb-1 col-12 " id="form-group1">
                        <label for="activite">Activité proposée</label>
                        <input type="text" name="activite" id="activite"  class="form-control w-100 text-danger">
                    </div>
                    <div class="form-group mb-1 col-12 " id="form-group2">
                        <label for="commentaire">Commentaire</label>
                        <textarea name="commentaire" id="commentaire" cols="30" rows="10"></textarea>
                    </div>
                    <div class="col-12 text-center mb-1 " id="form-group3">
                        <button class="btn btn-primary" >Enregistrer</button>
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
            echo "<td width='15%'>".date("d/m/Y", strtotime($inscrit['dateinsc']))."</td>" ;
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