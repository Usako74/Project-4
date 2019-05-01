<?php
/**
 * Created by PhpStorm.
 * User: Usako
 * Date: 30/04/2019
 * Time: 17:17
 */
echo $post['id'];
//$title = htmlspecialchars($post['title']);

ob_start(); ?>
    <main role="main" class="white-background">
        <p><a href="index.php">Retour à la liste des billets</a></p>

        <article class="news">
            <h3>

               <?= htmlspecialchars($post['title']) ?>
                <em>le <?= $post['creation_date_fr'] ?></em>
            </h3>

            <p>
                <?= nl2br(htmlspecialchars($post['content'])) ?>
            </p>
        </article>

        <h2>Commentaires</h2>

        <form action="index.php?action=addComment&amp;id=<?= $post['id'] ?>" method="post">
            <div>
                <label for="author">Auteur</label><br>
                <input type="text" id="author" name="author">
            </div>
            <div>
                <label for="comment">Commentaire</label><br>
                <textarea id="comment" name="comment"></textarea>
            </div>
            <div>
                <input type="submit">
            </div>
        </form>

        <?php
        while ($comment = $comments->fetch())
        {
            ?>
            <p><strong><?= htmlspecialchars($comment['author']) ?></strong> le <?= $comment['comment_date_fr'] ?></p>
            <p><?= nl2br(htmlspecialchars($comment['comment'])) ?></p>
            <?php
        }
        ?>

    </main>
<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>