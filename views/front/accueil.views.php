<?php
ob_start();
$titre1 = "BIEVENUE SUR LE SITE DES ACB 1992";
?>

<div class="alert alert-danger mt-5"><h2 class="text-center">CE SITE EST EN CONSTRUCTION</h2></div>

<section class="border border-light col-lg-8" id="article-a-la-une">
    <h2 class=" text-center bg-primary">A LA UNE</h3>
    <div class="card">
        <img src="<?= URL ?>public/images/articles/projet2022/IMG-20201109-WA0007.jpg" class="card-img-top" alt="...">
        <div class="card-body">    
            <h3 class="card-title">PROJET 2022 : QU'EST-CE ?</h3>
            <div class="card-text">
                <p>Le samedi 01/01/2021, le camarade Claude MALU a lancé dans le groupe Whatshapp des ACB92, une idée de création d'une entreprise privée dont les actionnaires seraient les membres de ce groupe. </p>
                <p>L'idée a immédiatement fait l'effet d'une bombe. Sans plus d'explications sur ce projet, les amis ont automatiquement compris l'importance d'un tel projet et se sont mis à le soutenir.</p>
                <p>Si vous voulez avoir plus de détail sur ce projet, <a href="<?= URL ?>projet2022">cliquez ici</a>. L'accès à cette page est réservé aux membres ayant créé un compte. Veuillez d'abord vous <a href="<?= URL ?>signup">inscrire</a></p>
            </div>
            
        </div>
    </div>
</section>

<?php
$content = ob_get_clean();
require "views/commons/template.php";
?>