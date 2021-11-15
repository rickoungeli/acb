
<!DOCTYPE html>
<html lang="en">

<head>
    
    <meta charset="utf-8">
    <meta name="robots" content="index, follow">
    <meta name="keywords" content="seo, google, site web, ...">
    <meta name="description" content="<?= $description ?> ">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="auteur" content="NGELI NSABAKA Rickou">
    <link rel="shortcut icon" type="image/png" href="<?= URL ?>public/images/icones/award-fill.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?= URL ?>public/css/style.css">
    <script src="https://kit.fontawesome.com/daa2a72b15.js" crossorigin="anonymous"></script>
    <title class="text-white"><?= $title ?></title>
</head>

<body class="bg-light rounded min-vh-100 row mx-auto" style="width: 98%;">


    <!-- contenu du site -->
    <main class="container col-lg-8 bg-white rounded-2 perso-main" style="min-height: 500px;">

        <div class="row no-gutters w-100">
            <form action="" method="POST" class="form col-12 col-md-8 col-lg-6  mx-auto bg-white shadow-sm p-3 rounded border border-secondary ">
                <div class="d-flex bg-dark text-white p-2 rounded-top text-align-center mx-auto mb-2">
                    <!-- Logo -->
                    <a href="<?= URL ?>accueil" class="rounded-circle p-0 m-0" style="max-height:60px; max-width:60px;">
                        <img src="<?= URL ?>public/images/icon.png" class="img-fluid rounded-circle mx-auto" style="max-height:60px; max-width:60px;">
                        <p class="text-align-center p-0 m-0 fw-bold container logo" style="font-size: 1rem;">ACB92</p>
                    </a>
                    <h4 class="text-white text-center mt-2">REINITIALISATION DU MOT DE PASSE </h4>
                </div>
                <?php if($ctrl == 0) { echo "<div class='alert alert-danger my-0' role='alert'>L'email est incorrect</div>";  } ?>
                <?php if($ctrl == 1) { echo "<div class='alert alert-success my-0' role='alert'><p class='fw-bold mb-1'>Votre demande a été prise en compte</p></br><p>Vous allez recevoir un lien de réinitialisation de votre mot de passe par courriel. Cela peut prendre quelques minutes.</p></div>";  } ?>

                <?php if($ctrl == 0) echo "<p class='mr-2 my-3 text-center'>Pour réinitialiser votre mot de passe, veuillez taper l’adresse électronique associé à votre compte </p>"; ?>
                
                <div class="form-group mb-2 mt-2 d-flex">
                    <label class="w-25">Nouveau mot de passe</label>
                    <div class="d-flex flex-column w-75">
                        <input type="password" class="form-control" name="passwordnew" id="passwordnew" placeholder="Nouveau mot de passe" value="<?php if(isset($_POST['passwordnew'])) echo $_POST['passwordnew'] ?>"required/>
                        <p class="title7 text-danger d-none mb-0" id="message-passwordnew">{{message.passwordnew}}</p>
                    </div>
                </div>

                <div class="form-group mb-2 mt-2 d-flex">
                    <label class="w-25">Confirmer mot de passe</label>
                    <div class="d-flex flex-column w-75">
                        <input type="password" class="form-control" name="passwordconfirm" id="passwordconfirm" placeholder="Confirmer mot de passe" required/>
                        <p class="title7 text-danger d-none mb-0" id="message-passwordconf">{{message.passwordconf}}</p>
                    </div>
                </div>

                <hr class="mb-1">

                <div class="row no-gutters">
                    <input type="submit" value="Valider" class="btn btn-primary btn-block col-11 mx-auto border-rounded">
                </div>

            </form>
        </div>


        <?php

        ?>

    </main>

    <!-- Footer du site -->
    <footer class="bg-dark text-white text-center rounded-bottom w-100">
        <p class="p-2">&copy; Rickou Ngeli 2021</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script type="text/javascript" src="<?= URL ?>public/js/eleves.js" async></script>
</body>

</html>