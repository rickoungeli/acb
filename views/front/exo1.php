<?php 
ob_start();
$titre1 = "";
?>

<?php if($alert !== "") { echo "<div class='alert alert-danger my-0' role='alert'>" . $alert . "</div>";  } ?>
<?php if($alert1 !== "") { echo "<div class='alert alert-success my-0' role='alert'>" . $alert1 . "</div>";  } ?>
<form action="" method="POST" class="d-flex flew-row justify-content-between mx-2 mb-1">
    <h2 class="align-middle">Activités proposées</h2>
    <input type="text" name="id_user" class="d-none"/>
    <a href="#" class="btn btn-primary" id="btn-show-overlay-add-activite">Proposer une activité" </a>
</form>

<!-- AFFICHAGE DES PROJETS PROPOSES -->

<section class="col-12" id="section-activites">
  
</section>
<?php echo "Nombre de propositions : ". count($propositions); ?>
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
                <form action="" method="post" class="row no-gutters form py-1 mb-0">

                    <div id="form-group-classe" class="form-group col-12 mb-1 d-flex flex-column mx-auto">
                        <label for="secteurs" class="form-label text-dark">Secteurs d'activité :</label>
                        <select name="secteurs" id="secteurs" class="form-select rounded">
                            <option value="#" selected="selected" >Sélectionner un secteur</option>
                            <option value="Commerce">Commerce</option>
                            <option value="Production">Production</option>
                            <option value="Service">Service</option>
                            <option value="Transformation">Transformation</option>
                        </select>
                    </div>

                    <div class="form-group mb-1 col-12" id="form-group1">
                        <label for="libelle"  class="form-label text-dark">Désignation de l'activité </label>
                        <input type="text" name="libelle" id="libelle" class="form-control w-100 text-danger" placeholder="Nom de l'activité" required>
                    </div>

                    <div class="form-group mb-1 col-12 d-flex flex-column" id="form-group2">
                        <label for="comment"  class="form-label text-dark">Votre Commentaire</label>
                        <textarea class="form-control" name="comment" id="comment" cols="30" rows="10"></textarea>
                    </div>
                    <div class="col-12 text-center mb-1 ">
                        <button class="btn btn-danger" id="btn-close-overlay">Annuler</button>
                        <button class="btn btn-primary" id="save-proposition-activites">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php 
$content = ob_get_clean() ;
require "./views/commons/template.php" ;
?>