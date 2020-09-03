<?php

/*
Plugin Name: Hahn Events
Description: A custom wordpress plugin which displays events
Author: Manuel Szecsenyi
Version: 0.1
Author URI: http://marginleft.at
*/

// Include acf
include "includes/acf-setup.php";

// Register Custom Post Type
include "includes/hahn-event-type.php";


add_action( 'init', 'hahn_event__add_custom_shortcode' );

function hahn_event__add_custom_shortcode() {
    add_shortcode( 'hahn-events', 'hahn_event_shortcode' );

    function hahn_event_shortcode( $atts ){
        return '

            <p>hello world</p>
        
        ';
    }

}