<?php
/**
 * Created by PhpStorm.
 * User: Usako
 * Date: 22/04/2019
 * Time: 09:22
 */
require('controller/frontend.php');
try {
    listPosts();
}
catch (Exception $e) {
    echo 'Une erreur c\'est produite : <br>' . $e->getMessage();
}