<?php include 'connexiondb.php' ;?>

<?php include 'navbarinclu.php' ;?>
<main class="accueilmain">
    <!-- Bannière principale -->
    <section class="banner">
        <img src="images_logo_icons/banner-image.jpg" alt="Image de bannière" class="img-fluid">
       <br><br> <div class="container inscri_conteneur">
            <div class="row">
                <div class="col-lg-8 mx-auto text-center" data-tilt data-tilt-axis="y">
                    <h1>Louez votre maison en toute simplicité</h1>
                    <a href="pagesearchhouse.php" class="cta-button" style="margin-top: 1rem; ">Voir les annonces </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Section des fonctionnalités -->
    <section class="features" data-tilt data-tilt-startX="20" data-tilt-startY="-20" data-tilt-reset-to-start="true">
        <div class=" inscri_conteneur">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                <div class="col-lg-5 col-md-4 col-sm-4 col-xs-4 control-label">
                    <div class="feature">
                        <img src="images_logo_icons/logositepro12.png" alt="Icône fonctionnalité 1" class="fonct1">
                        <div class="fonctionalite">
                            <h3>Recherche facile</h3>
                            <p>Trouvez rapidement la maison qui correspond à vos critères de recherche.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature">
                        <img src="images_logo_icons/foct2.png" alt="Icône fonctionnalité 2" style="margin-left: 40%;" class="fonct2">
                        <h3 style="margin-left: 40%;">Contact direct</h3>
                        <p style="margin-left: 40%;">Contactez directement les propriétaires des maisons qui vous intéressent.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature">
                    <i class="bi bi-sort-alpha-down" style="font-size: 300%"></i>
                        <a href="filtre.php"><h3>Filtre avancé</h3></a>
                        <p>Utilisez le filtre avancé pour affiner votre recherche et trouver la maison idéale.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Section des témoignages -->
    <section class="testimonials" data-tilt data-tilt-glare data-tilt-max-glare="0.8">
        <div class="container inscri_conteneur">
            <h2 class="text-center">Témoignages</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="testimonial">
                        <blockquote><p>
                            "Grâce à cette plateforme, j'ai pu facilement louer ma maison et trouver des locataires fiables. Je la recommande vivement !"
                            </p></blockquote>
                        <cite>- Ouattara Ali</cite>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="testimonial">
                        <blockquote><p>
                            "La recherche d'une maison à louer n'a jamais été aussi simple. J'ai trouvé exactement ce que je cherchais grâce à ce site."
                            </p></blockquote>
                        <cite>- Anne Marie</cite>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<div class="separateur" style="margin-top: 15%;"></div>