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
        <article class="news general-padding">
            <h3 class="title-design no-margin">
                <?= htmlspecialchars($data['title']) ?>
                <b>le <?= $data['create_date_fr'] ?></b>
            </h3>
            <p class="paragraph-design">
                <?= nl2br(htmlspecialchars($data['content'])) ?>
                <br>
                <b>
                    <a href="index.php?action=post&amp;id=<?= $data['id'] ?>">Afficher les commentaires</a>
                </b>
            </p>
        </article>
        <?php
    }
    $posts->closeCursor();
    ?>
</main>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>
