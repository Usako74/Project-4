<?php
/**
 * Created by PhpStorm.
 * User: Usako
 * Date: 06/05/2019
 * Time: 11:57
 */

$title = 'Billet simple pour L\'alaska - Administration';

ob_start(); ?>
    <header class="white-background">
        <h1 class="text-center no-margin">Billet simple pour l'Alaska</h1>
    </header>
    <main role="main" class="white-background">
        <h2 class="general-padding">Création d'un compte</h2>
        <p class="general-padding no-margin"><a href="index.php">Retour à la liste des billets</a></p>
        <form method="post">
            <div>
                <label>Titre</label>
                <input id="title" name="title">
            </div>
            <div>
                <textarea id="tiny" name="content"></textarea>
            </div>
            <div>
                <button type="submit">Envoyer</button>
            </div>
        </form>
    </main>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>

<script src='https://cloud.tinymce.com/5/tinymce.min.js?apiKey=urogiz8e1q5qmaovton6wqvvnys8yjztefkfdyi3tm1w970u'></script>
<script>
    tinymce.init({
        selector: '#tiny'
    });
</script>
