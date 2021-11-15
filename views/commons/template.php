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
    <title><?= $title ?></title>
</head>

<body class="rounded min-vh-100 row mx-auto" style="width: 98%;">
    <header class="container-fluid rounded-top mb-1 ">
        <div class="row no-gutters bg-dark text-white p-2 rounded-top ">
            <!-- Logo -->
            <a href="<?= URL ?>accueil" class="col-1 border border-white rounded-circle d-none d-md-inline-block p-0 m-0" style="max-height:80px; max-width:80px;">
                <img src="<?= URL ?>public/images/icon.png" class="img-fluid rounded-circle mx-auto" style="max-height:80px; max-width:80px;">
                <p class="text-center p-0 m-0 fw-bold container logo" style="font-size: 1rem;">ACB92</p>
            </a>

            <!-- Menu  -->
            <?php include('menu.php') ?>
        </div>

    </header>

    <!-- contenu du site -->
    <main class="container col-lg-8 bg-white rounded-2 perso-main" style="min-height: 500px;">
        <h1 class="container fs-1 text-center"><?php echo $titre1 ?></h1>
        <?= $content ?>
    </main>

    <!-- Footer du site -->
    <footer class="bg-dark text-white text-center rounded-bottom w-100">
        <p class="p-2">&copy; Rickou Ngeli 2021</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script type="text/javascript" src="<?= URL ?>public/js/eleves.js" async></script>
    <script type="text/javascript" src="<?= URL ?>public/js/projet2022.js" async></script>
</body>

</html>