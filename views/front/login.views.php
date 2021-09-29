<?php
ob_start();
$titre1 = "";
?>

<div class="row no-gutters w-100 m-0 align-items-center">
    <form action="" method="POST" class="form col-12 col-md-8 col-lg-6 mx-auto bg-white shadow-sm p-3 rounded border border-secondary ">
        <h1 class="text-center">Se connecter</h1>
        <p class="mr-2 mb-2 text-center title7">Vous n'avez pas de compte? <a href="signup" class="nav-link p-0 fsize d-inline">S'inscrire</a></p>
        <p class="alert alert-danger title7 d-none" id="message">Il y a des erreurs, veuillez vérifier votre saisie</p>
        
        <?php if($alert !== "") { echo "<div class='alert alert-danger my-0' role='alert'>" . $alert . "</div>";  } ?>

        <div class="form-group mb-2 mt-4 d-flex">
            <label class="w-25">Email</label>
            <div class="d-flex flex-column w-75">
                <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php if(isset($_POST['email'])) echo $_POST['email'] ?>" required />
                <p class="title7 text-danger d-none mb-0" id="message-email">{{message.email}}</p>
            </div>
        </div>

        <div class="form-group mb-2 d-flex">
            <label class="w-25">Mot de passe</label>
            <div class="d-flex flex-column w-75">
                <input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe" required />
                <p class="title7 text-danger d-none mb-0" id="message-pwd">{{message.pwd}}</p>
            </div>
        </div>

        <div class="row no-gutters ms-2">
            <input type="submit" value="Envoyer" class="btn btn-primary btn-block col-3">
        </div>

    </form>
</div>


<?php
$content = ob_get_clean();
require "views/commons/template.php";
?>