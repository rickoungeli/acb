<!DOCTYPE html>
<html lang="fr" class="bg-light">

<head>
    <meta charset="utf-8">
    <meta name="robots" content="index, follow">
    <meta name="keywords" content="seo, google, site web, ...">
    <meta name="description" content="<?= $description ?> ">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="auteur" content="NGELI NSABAKA Rickou">
    <link rel="shortcut icon" type="image/png" href="../public/images/icones/award-fill.svg">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <script src="https://kit.fontawesome.com/daa2a72b15.js" crossorigin="anonymous"></script>
    <title><?= $title ?></title>
</head>

<body class="bg-light rounded min-vh-100">
    <header class="rounded-top w-100 ">

        <div class="row bg-dark text-white p-2 rounded-top ">
            <!-- Logo -->
            <a href="?page=accueil" class="col-2 border border-white rounded-2" style="max-width:100px;">
                <div class="d-flex flex-column bg-secondary m-0 p-1 rounded-2">
                    <img src="../public/images/icon.png" class="img-fluid rounded-circle mx-auto">
                    <p class="text-center text-white p-0 align-middle container" style="font-size: 1rem;">ACB92</p>
                </div>
            </a>

            <!-- Menu  -->
            <?php include('menu.php') ?>
        </div>

    </header>

    <!-- contenu du site -->
    <div class="container w-100" style="min-height: 500px;">
        <h1 class="fs-1 mt-3 text-center"><?php echo $titre1 ?></h1>
        <?= $content ?>
    </div>

    <!-- Footer du site -->
    <footer class="bg-dark text-white text-center rounded-bottom w-100">

        <p class="p-2">&copy; Rickou Ngeli 2021</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./js/script.js" async></script>
    <script type="text/javascript" src="./js/listedeseleves.js" async></script>
</body>

</html>