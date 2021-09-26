<?php
ob_start();
$titre1 = "";
?>

<div class="row w-100">
    <form action="" method="POST" class="form col-12 col-md-8 col-lg-6  mx-auto bg-white shadow-sm p-3 rounded border border-secondary ">
        <h1 class="text-center">S'inscrire</h1>
        <p class="mr-2 mb-2 text-center  title7">Vous avez déjà un compte? <a href="?page=login" class="nav-link p-0 fsize d-inline">Se connecter</a></p>
        <p class="alert alert-danger title7 d-none" id="message">Il y a des erreurs, veuillez vérifier votre saisie</p>

        <?php if($alert !== "") { echo "<div class='alert alert-danger my-0' role='alert'>" . $alert . "</div>";  } ?>
        <?php if($alert1 !== "") { echo "<div class='alert alert-success my-0' role='alert'>" . $alert1 . "</div>";  } ?>

        <div class="form-group mb-2 mt-2 d-flex">
            <label class="w-25">Prénom</label>
            <div class="d-flex flex-column w-75">
                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Prénom" value="<?php if(isset($_POST['firstname'])) echo $_POST['firstname'] ?>" required/>
                <p class="title7 text-danger mb-0 d-none" id="message-firstname">{{message.firstname}}</p>
            </div>
        </div>
        
        <div class="form-group mb-2 mt-2 d-flex">
            <label class="w-25">Nom</label>
            <div class="d-flex flex-column w-75">
                <input type="text" class="form-control" name="name" id="name" placeholder="Nom" value="<?php if(isset($_POST['name'])) echo $_POST['name'] ?>" required/>
                <p class="title7 text-danger d-none mb-0" id="message-name">{{message.name}}</p>
            </div>
        </div>

        <div class="form-group mb-2 mt-2 d-flex">
            <label class="w-25">Email</label>
            <div class="d-flex flex-column w-75">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php if(isset($_POST['email'])) echo $_POST['email'] ?>"required/>
                <p class="title7 text-danger d-none mb-0" id="message-email">{{message.email}}</p>
            </div>
        </div>

        <div class="form-group mb-2 mt-2 d-flex">
            <label class="w-25">Téléphone</label>
            <div class="d-flex flex-column w-75">
                <input type="text" class="form-control" name="phone" id="email" placeholder="Téléphone" value="<?php if(isset($_POST['phone'])) echo $_POST['phone'] ?>"/>
                <p class="title7 text-danger d-none mb-0" id="message-phone">{{message.phone}}</p>
            </div>
        </div>
        
        <div class="form-group mb-2 mt-2 d-flex">
            <label class="w-25">Pays de résidence</label>
            <div class="d-flex flex-column w-75">
                <input type="text" class="form-control" name="country" id="country" placeholder="Pays de résidence" value="<?php if(isset($_POST['country'])) echo $_POST['country'] ?>"/>
                <p class="title7 text-danger d-none mb-0" id="message-pays">{{message.pays}}</p>
            </div>
        </div>

        <hr class="mb-1">

        <div class="form-group mb-2 d-flex">
            <label class="w-25">Mot de passe</label>
            <div class="d-flex flex-column w-75">
                <input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe" value="<?php if(isset($_POST['password'])) echo $_POST['password'] ?>"required/>
                <p class="title7 text-danger d-none mb-0" id="message-pwd">{{message.password}}</p>
            </div>
        </div>

        <div class="form-group mb-2 d-flex">
            <label class="w-25">Confirmer Mot de passe</label>
            <div class="d-flex flex-column w-75">
                <input type="password" class="form-control" name="password-confirm" id="password-confirm" placeholder="Mot de passe" required/>
                <p class="title7 text-danger d-none mb-0" id="message-pwd-2">{{message.passwordConfirm}}</p>
            </div>
        </div>
        <div class="row no-gutters ms-2">
            <input type="submit" value="Envoyer" class="btn btn-primary btn-block col-3">
        </div>

    </form>
</div>

<?php

?>


<?php
$content = ob_get_clean();
require "views/commons/template.php";
?>