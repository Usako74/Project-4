<?php
/**
 * Created by PhpStorm.
 * User: Usako
 * Date: 03/05/2019
 * Time: 10:52
 */

$title = 'Billet simple pour L\'alaska - Login';

ob_start(); ?>
    <header class="white-background">
        <h1 class="text-center no-margin">Billet simple pour l'Alaska</h1>
    </header>
    <main role="main" class="white-background">
        <h2 class="general-padding">Création d'un compte</h2>
        <p class="general-padding no-margin"><a href="index.php">Retour à la liste des billets</a></p>
        <form action="index.php?action=register" method="post" class="general-padding">
            <div>
                <label for="pseudo">Identifiant:</label><br>
                <input type="text" id="pseudo" name="pseudo">
            </div>
            <div>
                <label for="password">Mot de passe:</label><br>
                <input type="password" id="password" name="password">
            </div>
            <div>
                <label for="password">Mot de passe:</label><br>
                <input type="password" id="password2" name="password2">
            </div>
            <div>
                <label for="email">Adresse E-Mail:</label><br>
                <input type="text" id="email" name="email">
            </div>
            <div>
                <button type="submit">S'inscrire</button>
            </div>
        </form>
    </main>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>


