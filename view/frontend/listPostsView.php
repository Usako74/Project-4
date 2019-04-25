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
<h2 class="">Titre de la liste des articles</h2>
<p>Liste des articles:</p>

<?php
while ($data = $posts->fetch())
{
?>
    <div class="news">
        <h3>
            <?= htmlspecialchars($data['title']) ?>
            <b>le <?= $data['create_date_fr'] ?></b>
        </h3>

        <p>
            <?= nl2br(htmlspecialchars($data['content'])) ?>
            <br>
            <b><a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Afficher les commentaires</a></b>
        </p>
    </div>
<?php
}
$posts->closeCursor();
?>


<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
