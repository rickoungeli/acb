<?php
ob_start();
$titre1 = "";
?>

<main class="row no-gutters" id="new-post-input">
    <section class="col-12 col-md-8">
        <form class="w-100 d-flex border border-light mb-2">
            <img src="../../public/images/profil_picture.png" style="width:50px;" class="card-img-top profil-picture rounded-circle" alt=""> 
            <input type="text" id="new-post-input" placeholder="Votre publication" class="w-100 rounded-pill mb-1 border border-secondary ps-2">
        </form>

        <article class="card mb-2 p-1 ">
            <header class="d-flex justify-content-between">
                <!-- L'UTILISATEUR QUI A PUBLIE -->
                <div class="d-flex" id='user-infos'> 
                    <img src="../../public/images/profil_picture.png" style="width:50px;" class="card-img-top profil-picture rounded-circle" alt=""> 
                    <div class="card-text d-flex flex-column">
                        <p class="fw-bold m-0 text-shadow"> Administrateur  </p>
                        <small class=" m-0"> Publiée le 01/09/2021 09:46 </small>
                    </div>
                </div>

                <!-- MENU PUBLICATIONS -->
                <nav class="nav-item dropdown me-2 rounded-circle">
                    <span class="btn rounded-circle text-center" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" >
                        <i class="fas fa-ellipsis-v align-middle"></i>
                    </span>
                    <ul class="dropdown-menu bg-secondary post-menu ">
                        <li v-if="user.id==post.user.id" v-on:click="toggleUpdatePost(post)" class="dropdown-item text-white btn"><i class="fa fa-paste"></i> Modifier </li>
                        <li v-if="user.id==post.user.id"><hr class="dropdown-divider text-white"></li>
                        <li v-if="user.is_moderator==1 || user.id==post.user.id" @click="removePost(post)" class="dropdown-item text-white btn"><i class="fa fa-trash-o"></i>  Supprimer </li>
                    </ul>
                </nav>
            </header>
            <h4 class="card-title text-danger fw-bold text-uppercase text-decoration-underline">PROJET 2022 : QU'EST-CE ?</h4>
            <img src="<?= URL ?>public/images/articles/projet2022/IMG-20201109-WA0007.jpg" class="card-img-top" alt="...">
            <div class="card-body p-2">    
                
                <div class="card-text">
                    <p class="m-0">Le samedi 01/01/2021, le camarade Claude MALU a lancé dans le groupe Whatshapp des ACB92, une idée de création d'une entreprise privée dont les actionnaires seraient les membres de ce groupe. </p>
                    <a href="#">Lire la suite...</a>
                    <div id="suite" class="d-none">
                    <p>L'idée a immédiatement fait l'effet d'une bombe. Sans plus d'explications sur ce projet, les amis ont automatiquement compris l'importance d'un tel projet et se sont mis à le soutenir.</p>
                    <p>Si vous voulez avoir plus de détail sur ce projet, <a href="<?= URL ?>projet2022">cliquez ici</a>. L'accès à cette page est réservé aux membres ayant créé un compte. Veuillez d'abord vous <a href="<?= URL ?>signup">inscrire</a></p>
                    </div>
                </div>
                
            </div>
            <!-- FORMULAIRE DE SAISIE D'UN COMMENTAIRES -->
            <form class="d-flex" name="form-new-comment">
                <input type="text" class="form-control m-2 " placeholder="Votre commentaire">
                <button class="btn py-0 px-3 me-2 mt-2 border border-secondary rounded text-align-center">Ajouter</button>
            </form>
        </article>
    </section>







    <aside class="border border-light px-0 mx-auto col-12 col-md-4"  id="article-recents">    
        <h5 class="py-1 text-center text-white bg-primary mb-1 rounded-2">NOTIFICATIONS</h5>
        <div class="row p-0 mx-auto" >
            <div class="card mx-0 mb-1 ms-2 col-sm-5 col-md-12 mx-auto" style="font-size: 1em;">
                <h6 class="card-title text-danger fw-bold text-uppercase text-decoration-underline">REUNION ZOOM</h6>
                <div class="card-body p-1 reunion">    
                    
                    <div class="card-text">
                        <p>Le Groupe ACB92 invite tous les membres inscrits au Projet2022 à participer à une réunion zoom de prise de contact</p>
                        <p>Date et heure de la réunion : <span class="fw-bold">Le 14/11/2021</span> à <span class="fw-bold">17h30 GMT</span> (18h30 heure de Kinshasa)</p>
                        <p>ID de la réunion : <span class="fw-bold">835 7630 2110 </span><br> Code secret : <span class="fw-bold"> 040383</span></p>
                        <p class="text-center"><a href="https://us02web.zoom.us/j/83576302110?pwd=Z0tFVEYvM1JVYIpqTit6S21LV1|OZz09" class="btn btn-success rounded-2">Participer à la réunion</a></p>
                    </div>
                </div>
            </div>
            <div class="card mx-0 mb-1 ms-2 col-sm-5 col-md-12 mx-auto" style="font-size: .8em;">
                
                <div class="card-body p-1">    
                    <h6 class="card-title text-danger fw-bold text-uppercase text-decoration-underline">LOREM IPSUM DOLOR</h6>
                    <div class="card-text">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quis qui veniam molestiae soluta alias, ratione distinctio fugit ab, voluptas, commodi eveniet doloribus. </p>
                        <a href="#">Lire la suite...</a>
                    </div>
                </div>
            </div>

    </aside>
</main>
<?php
$content = ob_get_clean();
require "views/commons/template.php";
?>