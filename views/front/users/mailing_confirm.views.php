
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
                    <h3 class="text-white text-center mt-2">MOT DE PASSE OUBLIE</h3>
                </div>
                
                <?php echo "<div class='alert alert-success my-0' role='alert'><p class='fw-bold mb-1'>Nous venons de vous envoyer un email</p></br><p>Celui-ci contient un lien permettant de réinitaliser votre mot de passe</p></div>";  ?>

                <?php echo "<p class='mr-2 my-3 text-center'>Si vous ne l'avez pas reçu, pensez à vérifier dans vos courriers indésirables </p>"; ?>
                
                <hr class="mb-1">
                <div class="form-group mb-2 mt-2 d-flex">
                    
                    <div class="d-flex flex-column w-75">
                        <input type="reset" class="btn btn-success btn-block col-11 mx-auto border-rounded" name="retour" id="retour"  value="Retour"/>
                        
                    </div>
                </div>



            </form>
        </div>


    </main>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script type="text/javascript" src="<?= URL ?>public/js/eleves.js" async></script>
</body>

</html>