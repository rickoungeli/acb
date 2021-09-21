<?php
ob_start();
$titre1 = "";
?>

<div class="row w-100">
    <form action="" method="POST" class="form col-12 col-md-8 col-lg-6  mx-auto bg-white shadow-sm p-3 rounded border border-secondary ">
        <h1 class="text-center">S'inscrire</h1>
        <p class="mr-2 mb-2 text-center  title7">Vous avez déjà un compte? <a href="<?= URL ?>login" class="nav-link p-0 fsize d-inline">Se connecter</a></p>
        <p class="alert alert-danger title7 d-none" id="message">Il y a des erreurs, veuillez vérifier votre saisie</p>
        
        <div class="form-group mb-2 mt-2 d-flex">
            <label class="w-25">Prénom</label>
            <div class="d-flex flex-column w-75">
                <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Prénom" required/>
                <p class="title7 text-danger mb-0 d-none" id="message-firstname">{{message.firstname}}</p>
            </div>
        </div>
        
        <div class="form-group mb-2 mt-2 d-flex">
            <label class="w-25">Nom</label>
            <div class="d-flex flex-column w-75">
                <input type="text" class="form-control" name="name" id="name" placeholder="Nom" required/>
                <p class="title7 text-danger d-none mb-0" id="message-name">{{message.name}}</p>
            </div>
        </div>
        
        <div class="form-group mb-2 mt-2 d-flex">
            <label class="w-25">Email</label>
            <div class="d-flex flex-column w-75">
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" required/>
                <p class="title7 text-danger d-none mb-0" id="message-email">{{message.email}}</p>
            </div>
        </div>

        <div class="form-group mb-2 d-flex">
            <label class="w-25">Mot de passe</label>
            <div class="d-flex flex-column w-75">
                <input type="password" class="form-control" name="password" id="password" placeholder="Mot de passe" required/>
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
        <div class="row no-gutters">
            <input type="submit" value="Envoyer" class="btn btn-primary btn-block col">
        </div>

    </form>
</div>

<?php

?>


<?php
$content = ob_get_clean();
require "views/commons/template.php";
?>