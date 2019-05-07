<?php
/**
 * Created by PhpStorm.
 * User: Usako
 * Date: 01/05/2019
 * Time: 18:18
 */

$title = 'Billet simple pour L\'alaska - Login';
ob_start(); ?>
    <header class="white-background">
        <h1 class="text-center no-margin">Billet simple pour l'Alaska</h1>
    </header>
    <main role="main" class="white-background">
       <h2 class="general-padding">Veuillez renseigner l'identifiant et le mot de passe:</h2>
        <p class="general-padding no-margin"><a href="index.php">Retour à la liste des billets</a></p>
        <form action="index.php?action=login" method="post" class="general-padding">
            <div>
                <label for="pseudo">Identifiant:</label><br>
                <input type="text" id="pseudo" name="pseudo">
            </div>
            <div>
                <label for="password">Mot de passe:</label><br>
                <input type="password" id="password" name="password">
            </div>
            <div>
                <button type="submit">Se connecter</button>
            </div>
        </form>
    </main>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>