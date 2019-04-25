<?php
/**
 * Created by PhpStorm.
 * User: Usako
 * Date: 22/04/2019
 * Time: 09:19
 */
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
    <link href="https://fonts.googleapis.com/css?family=Jura" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Special+Elite" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link href="public/css/style.css" rel="stylesheet">
</head>

<body>
<?php include('header.php'); ?>

<?= $content ?>

<?php include('footer.php'); ?>
</body>
</html>