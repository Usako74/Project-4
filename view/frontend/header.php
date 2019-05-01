<?php
/**
 * Created by PhpStorm.
 * User: Usako
 * Date: 25/04/2019
 * Time: 12:23
 */
?>
<header class="white-background height_header">
    <div class="display-flex space-content">
        <h1 class="text-center no-margin">Billet simple pour l'Alaska</h1>
        <a href="index.php?action=login" class="align-self-center">Administration</a>
    </div>
    <div id="slider" class="slider display-flex">
        <div class="display-flex">
            <figure class="showslider position-absolute">
                <img src="public/img/aurora.jpg" alt="Photo d'une aurore boréale" class="full-size">
            </figure>
            <figure  class="showslider position-absolute transparency">
                <img src="public/img/fjord.jpg" alt="Photo d'un paysage montagneux" class="full-size">
            </figure>
            <figure  class="showslider position-absolute transparency">
                <img src="public/img/lake.jpg" alt="Photo d'un lac" class="full-size">
            </figure>
            <figure  class="showslider position-absolute transparency">
                <img src="public/img/iceberg.jpg" alt="Photo d'un iceberg" class="full-size">
            </figure>
        </div>
        <i class="fas fa-angle-left fa-2x position-absolute left align-self-center white-color background-icon" id="button_left"></i>
        <i class="fas fa-angle-right fa-2x position-absolute right align-self-center white-color background-icon" id="button_right"></i>
        <div class="display-flex icon-center">
            <i class="far fa-pause-circle fa-4x position-absolute pause white-color background-icon" id="button_pause"></i>
            <i class="far fa-play-circle fa-4x position-absolute play white-color background-icon" id="button_play"></i>
        </div>
    </div>
</header>