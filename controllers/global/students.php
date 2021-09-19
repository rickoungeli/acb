<?php 
$titre1 = "LISTE DES ELEVES";
include("../common/header.php") ;

?>

<!-- =============FORMULAIRE D'OPTIONS ===================== -->

<?php //echo styleTitreNiveau2('Liste des élèves') ?>

<form class="form p-1 d-flex flex-wrap w-100 justify-content-center border border-2 bg-light rounded-3" method="POST" action="" id="formOptions">
    <div class="form-group me-1 w-25">
        <label for="combo-annee-scolaire">Année Scolaire</label>
        <select class="form-select p-1" id="combo-annee-scolaire" name="annee-scolaire" placeholder="Année Scolaire">
            <option value="#" checked="checked">Sélectionner</option>
            <option value="1">1986-1987</option>
            <option value="2">1987-1988</option>
            <option value="3">1988-1989</option>
            <option value="4">1989-1990</option>
            <option value="5">1990-1991</option>
            <option value="6">1991-1992</option>
            <option value="7">1992-1993</option>
            <option value="8">1993-1994</option>
            <option value="9">1994-1995</option>
            <option value="10">1995-1996</option>
        </select>
    </div>
    <div class="form-group me-1 w-25">
    <label for="combo-section">Section</label>
        <select class="form-select p-1" id="combo-section" name="section" onclick="chargerComboClasse()">
            <option value="#" checked="checked">Sélectionner</option>
            <option value="1">Primaire</option>
            <option value="2">Secondaire</option>
            <option value="3">Littéraire</option>
            <option value="4">Scientifique</option>
        </select>
    </div>
    <div class="form-group me-1 w-25">
        <label for="combo-classe">Classe</label>
        <select class="form-select p-1" id="combo-classe" name="classe">
            <option value="#" checked="checked">Sélectionner</option>
            <?php
            //function chargerComboClasse() {
                $bdd = new PDO("mysql:host=". HOST_NAME ."; dbname=". DATABASE_NAME ."; charset=utf8", USER_NAME, PASSWORD);
                $stmt = $bdd->prepare("SELECT * FROM classes");
                $stmt->execute();
                //$resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $resultat = $stmt->fetchAll();
                $stmt->closeCursor();
                echo "<pre>";
                print_r($resultat);
                for($i=0; $i<count($resultat); $i++) {print_r("<option value=". $resultat[$i][0]. ">". $resultat[$i][1]. "</option>");}
            //}
            ?>
        </select>
    </div>
    <div class="form-group">
        <button class="btn btn-success rounded py-0 px-2" type="submit" id="bouton1">ok</button>
    </div>
    
</form>

<!-- =========================SECTIONS 1 : LISTE DES ELEVES===================== -->

<section class="" id="section-eleves">
    <h2 class="fs-4" id="sous-titre1">  </h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Noms</th>
                <th scope="col">Prénoms</th>
                <th scope="col">Pays de résidence</th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            $bdd = new PDO("mysql:host=". HOST_NAME ."; dbname=". DATABASE_NAME ."; charset=utf8", USER_NAME, PASSWORD);
            $stmt = $bdd->prepare("SELECT elevesparclasse.id_eleve AS id_eleve, eleves.noms AS noms,  eleves.prenom AS prenom, eleves.residence_actuelle AS residence FROM elevesparclasse, eleves WHERE elevesparclasse.id_eleve=eleves.id_eleve ORDER BY noms, prenom ASC");
            $stmt->execute();
            //$resultat = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $resultat = $stmt->fetchAll();
            $stmt->closeCursor();
            echo "<pre>";
            for($i=0; $i<count($resultat); $i++) {
                print_r("<tr><th scope='row'>1</th><td>".$resultat[$i][1]."</td><td>".$resultat[$i][2]."</td><td>".$resultat[$i][3]."</td><td class='d-none'>".$resultat[$i][0]."</td><td><a href='' class='btn btn-warning fs-6 px-2 m-0'><i class='fas fa-pencil-alt'></i></a></td><td><a href='' class='btn btn-danger fs-6 px-2 m-0'><i class='fas fa-trash-alt'></i></a></td></tr>");
            }
            //}
            ?>
        </tbody>
    </table>
    <button class="btn btn-success d-block  py-1 px-3" id="btnAjoutEleves">Ajouter un élève dans cette classe</button>
</section>
<!-- =========================SECTIONS 2 AJOUT DES ELEVES ===================== -->
<section class="mt-2 mb-2 p-2 d-none">
    <form class="form p-2 rounded-2 mx-auto d-flex flex-column" method="POST" action="" id="formAjoutEleve">
        <div class="row w-100 mx-auto">
            <div class="form-group col-12 col-sm-6">
                <label for="noms">Noms :</label>
                <input class="form-control" type="text" id="noms" name="noms" required>
            </div>
            <div class="form-group col-12 col-sm-6">
                <label for="prenom">Prénom :</label>
                <input class="form-control" type="text" id="prenom" name="prenom">
            </div>
        </div>
        <div class="row w-100 mx-auto">
            <div  class="form-group col-12 col-sm-6">
                <label class="form-label" for="dnaiss">Date de naissance (Facultatif) :</label>
                <input class="form-control" type="text" id="dnaiss" name="dnaiss">
            </div>
            <div  class="form-group col-12 col-sm-6">
                <label class="form-label" for="residence">Pays de résidence :</label>
                <input class="form-control" type="text" id="residence" name="residence">
            </div>
        </div>
        <button class="btn btn-success d-block py-1 px-4 mt-2" id="btnAjoutEleves">Valider</button>
    </form>
</section>
          
<?php include("../common/footer.php") ?>