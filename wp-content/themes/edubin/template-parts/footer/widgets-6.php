<?php
/**
 * Displays footer widgets if assigned
 *
 * @package Edubin
 * Version: 1.0.0
 */

?>

<div class="footer-top">
    <div class="container">
        <div class="row footer-wrap">
            <div class="col-lg-4 col-md-6">
                <div class="footer-column">
                    <?php dynamic_sidebar( 'footer-1' ); ?>     
                </div>
             </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-column">
                    <?php dynamic_sidebar( 'footer-2' ); ?>     
                </div>
             </div>
            <div class="col-lg-2 col-md-6">
                <div class="footer-column">
                    <?php dynamic_sidebar( 'footer-3' ); ?>     
                </div>
             </div>
            <div class="col-lg-3 col-md-6">
                <div class="footer-column">
                    <?php dynamic_sidebar( 'footer-4' ); ?>     
                </div>
             </div>
        </div>
    </div>
</div>