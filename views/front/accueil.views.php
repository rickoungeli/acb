<?php
ob_start();
$titre1 = "";
//$hash = password_hash("rickou", PASSWORD_DEFAULT);
//echo $hash;
?>

<div class="alert alert-danger mt-2"><h2 class="text-center">CE SITE EST EN CONSTRUCTION</h2></div>

<section class="row no-gutters" id="article-a-la-une">
    <div class="border border-light col-12 col-md-8">
        <h2 class="py-1 text-center bg-primary">A LA UNE</h3>
        <div class="card mb-2">
            <img src="<?= URL ?>public/images/articles/projet2022/IMG-20201109-WA0007.jpg" class="card-img-top" alt="...">
            <div class="card-body p-2">    
                <h3 class="card-title text-danger fw-bold text-uppercase text-decoration-underline">PROJET 2022 : QU'EST-CE ?</h3>
                <div class="card-text">
                    <p>Le samedi 01/01/2021, le camarade Claude MALU a lancé dans le groupe Whatshapp des ACB92, une idée de création d'une entreprise privée dont les actionnaires seraient les membres de ce groupe. </p>
                    <p>L'idée a immédiatement fait l'effet d'une bombe. Sans plus d'explications sur ce projet, les amis ont automatiquement compris l'importance d'un tel projet et se sont mis à le soutenir.</p>
                    <p>Si vous voulez avoir plus de détail sur ce projet, <a href="<?= URL ?>projet2022">cliquez ici</a>. L'accès à cette page est réservé aux membres ayant créé un compte. Veuillez d'abord vous <a href="<?= URL ?>signup">inscrire</a></p>
                </div>
                
            </div>
        </div>
    </div>
    <aside class="border border-light px-0 mx-auto col-12 col-md-4"  id="article-recents">    
        <h2 class="py-1 text-center bg-primary mb-1">ARTICLES RECENTS</h3>
        <div class="row p-0 mx-auto" >
            <div class="card mx-0 mb-1 ms-2 col-sm-5 col-md-12 mx-auto" style="font-size: .8em;">
                <img src="<?= URL ?>public/images/articles/projet2022/IMG-20201109-WA0007.jpg" class="card-img-top mt-1" alt="...">
                <div class="card-body p-1">    
                    <h3 class="card-title text-danger fw-bold text-uppercase text-decoration-underline">LOREM IPSUM DOLOR</h3>
                    <div class="card-text">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis qui veniam molestiae soluta alias, ratione distinctio fugit ab, voluptas, commodi eveniet doloribus.</p>
                        <a href="#">Lire la suite...</a>
                    </div>
                </div>
            </div>
            <div class="card mx-0 mb-1 ms-2 col-sm-5 col-md-12 mx-auto" style="font-size: .8em;">
                <img src="<?= URL ?>public/images/articles/projet2022/IMG-20201109-WA0007.jpg" class="card-img-top mt-1" alt="...">
                <div class="card-body p-1">    
                    <h3 class="card-title text-danger fw-bold text-uppercase text-decoration-underline">LOREM IPSUM DOLOR</h3>
                    <div class="card-text">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis qui veniam molestiae soluta alias, ratione distinctio fugit ab, voluptas, commodi eveniet doloribus. </p>
                        <a href="#">Lire la suite...</a>
                    </div>
                </div>
            </div>
            <div class="card mx-0 mb-1 ms-2 col-sm-5 col-md-12 mx-auto" style="font-size: .8em;">
                <img src="<?= URL ?>public/images/articles/projet2022/IMG-20201109-WA0007.jpg" class="card-img-top mt-1" alt="...">
                <div class="card-body p-1">    
                    <h3 class="card-title text-danger fw-bold text-uppercase text-decoration-underline">LOREM IPSUM DOLOR</h3>
                    <div class="card-text">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis qui veniam molestiae soluta alias, ratione distinctio fugit ab, voluptas, commodi eveniet doloribus. Dicta excepturi.</p>
                        <a href="#">Lire la suite...</a>
                    </div>
                </div>
            </div>
            <div class="card mx-0 mb-1 ms-2 col-sm-5 col-md-12 mx-auto" style="font-size: .8em;">
                <img src="<?= URL ?>public/images/articles/projet2022/IMG-20201109-WA0007.jpg" class="card-img-top mt-1" alt="...">
                <div class="card-body p-1 ">    
                    <h3 class="card-title text-danger fw-bold text-uppercase text-decoration-underline">LOREM IPSUM DOLOR</h3>
                    <div class="card-text">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis qui veniam molestiae soluta alias.</p>
                        <a href="#">Lire la suite...</a>
                    </div>
                </div>
            </div>
        </div>
    </aside>
</section>
<?php
$content = ob_get_clean();
require "views/commons/template.php";
?>