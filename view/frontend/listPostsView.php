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
<main role="main" class="white-background">
    <h2 class="no-margin general-padding">Titre de la liste des articles</h2>

    <?php
    while ($data = $posts->fetch())
    {
        ?>
        <article class="paragraph-design">
            <h3 class="title-design no-margin">
                <?= htmlspecialchars($data['title']) ?>
                <b>le <?= $data['create_date_fr'] ?></b>
            </h3>
            <p class="general-padding no-margin">
                <?= nl2br(htmlspecialchars($data['content'])) ?>
            </p>
            <b>
                <a href="index.php?action=post&amp;id=<?= $data['id']?>" class="general-padding">Afficher les commentaires</a>
            </b>
        </article>
        <?php
    }
    $posts->closeCursor();
    ?>
</main>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
