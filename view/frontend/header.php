<?php
/**
 * Created by PhpStorm.
 * User: Usako
 * Date: 25/04/2019
 * Time: 12:23
 */
?>
<header class="white-background">
    <h1 class="text-center no-margin">Billet simple pour l'Alaska</h1>
    <div id="slider" class="slider display-flex">
        <div class="display-flex">
            <figure class="showslider position-absolute">
                <img src="public/img/pinguin.jpg" alt="Illustration de pinguins sur la neige" class="full-size">
            </figure>
            <figure  class="showslider position-absolute transparency">
                <img src="public/img/igloo.jpg" alt="Illustration d'un igloo au milieu de la neige" class="full-size">
            </figure>
            <figure  class="showslider position-absolute transparency">
                <img src="public/img/cerf&biche.jpg" alt="Illustration d'un cerf et d'une biche sur la neige" class="full-size">
            </figure>
        </div>
        <i class="fas fa-angle-left fa-2x position-absolute left align-self-center" id="button_left"></i>
        <i class="fas fa-angle-right fa-2x position-absolute right align-self-center" id="button_right"></i>
        <div class="display-flex icon-center">
            <i class="far fa-pause-circle fa-4x position-absolute pause" id="button_pause"></i>
            <i class="far fa-play-circle fa-4x position-absolute play" id="button_play"></i>
        </div>
    </div>
</header>