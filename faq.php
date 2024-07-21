<?php include_once('connexiondb.php'); ?>
<?php include('navbarinclu.php'); ?>
<br><br><br><br><br><br><br><br><br><br>
    <div class="container">
        <h1 class="mt-5">Foire aux Questions</h1>

        <?php
        // Code de connexion à la base de données

        // Récupérer les questions et réponses de la base de données
        $faqs = array(
            array('question' => 'Qu\'est-ce que votre site propose?', 'reponse' => 'Notre site propose des services de recherche de maisons à louer.'),
            array('question' => 'Comment puis-je publier une annonce de location?', 'reponse' => 'Pour publier une annonce, vous devez créer un compte et accéder à votre tableau de bord.'),
            // Ajoutez plus de questions et réponses ici
        );

        if (empty($faqs)) {
            echo '<p>Aucune question disponible pour le moment.</p>';
        } else {
            echo '<div class="accordion mt-3" id="faqAccordion">';
            foreach ($faqs as $index => $faq) {
                echo '<div class="accordion-item">';
                echo '<h2 class="accordion-header" id="heading' . $index . '">';
                echo '<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse' . $index . '" aria-expanded="true" aria-controls="collapse' . $index . '">';
                echo $faq['question'];
                echo '</button>';
                echo '</h2>';
                echo '<div id="collapse' . $index . '" class="accordion-collapse collapse" aria-labelledby="heading' . $index . '" data-bs-parent="#faqAccordion">';
                echo '<div class="accordion-body">';
                echo $faq['reponse'];
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
            echo '</div>';
        }
        ?>
    </div>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
    <?php include('footerinclu.php'); ?>