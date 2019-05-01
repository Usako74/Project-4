<?php
/**
 * Created by PhpStorm.
 * User: Usako
 * Date: 30/04/2019
 * Time: 17:17
 */
$title = htmlspecialchars($post['title']);

ob_start(); ?>
    <main role="main" class="white-background">
        <p class="articles-padding no-margin"><a href="index.php">Retour à la liste des billets</a></p>

        <article class="news articles-padding">
            <h3 class="title-design no-margin">

                <?= htmlspecialchars($post['title']) ?>
                <em>le <?= $post['creation_date_fr'] ?></em>
            </h3>

            <p class="paragraph-design">
                <?= nl2br(htmlspecialchars($post['content'])) ?>
            </p>
        </article>

        <article class="articles-padding no-margin">
            <h2 class="title-design no-margin">Commentaires</h2>

            <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post" class="articles-padding">
                <div>
                    <label for="author">Auteur</label><br>
                    <input type="text" id="author" name="author">
                </div>
                <div>
                    <label for="comment">Commentaire</label><br>
                    <textarea id="comment" name="comment"></textarea>
                </div>
                <div>
                    <button type="submit">Envoyer</button>
                </div>
            </form>

            <?php
            while ($comment = $comments->fetch())
            {
                ?>
                <div class="comment-design">
                    <p class="no-margin title-design"><b><?= htmlspecialchars($comment['author']) ?></b> le <?= $comment['comment_date_fr'] ?></p>
                    <p class="paragraph-design"><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
                </div>
                <?php
            }
            ?>
        </article>
    </main>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>