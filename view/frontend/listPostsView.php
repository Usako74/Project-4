<?php
/**
 * Created by PhpStorm.
 * User: Usako
 * Date: 22/04/2019
 * Time: 10:12
 */
?>

<?php $title = 'Billet simple pour l\'Alaska'; ?>

<?php ob_start(); ?>
<h1>Titre de la liste des articles</h1>
<p>Liste des articles:</p>



<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
