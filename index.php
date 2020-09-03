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

        // default attributes
        $atts = shortcode_atts( array(
            'upcoming' => true
        ), $atts );

        $display_upcoming_events = ( $atts["upcoming"] === "false" ) ? false : true;


        // Find todays date in Ymd format.
        $today = date('Ymd');

        $args = array(
            'post_type'              => 'event',
            'meta_key'                => 'date',
            'orderby'   => 'meta_value_num',
            'order'     => 'DESC',
            'meta_query' => array( // filter data here
                array(
                    'key'     => 'date',
                    'compare' => $display_upcoming_events ? '>=' : '<',
                    'value'   => $today,
                )
            ),
        );


        // WP_Query arguments

        // The Query
        $query = new WP_Query( $args );

        $buffer = "";

        if ( $query->have_posts() ) {
            $buffer = $buffer.'<ul>';

            while ( $query->have_posts() ) {
                // Sets up the current post.
                $query->the_post();

                // open row
                $buffer = $buffer.'<div class="events-row">';

                    // open event
                    $buffer = $buffer.'<div class="events-date">';

                        $event_date = strtotime( get_field("date") );

                        $buffer = $buffer.'<span class="events-date-day">'.date("d", $event_date).'</span>';
                        $buffer = $buffer.'<span class="events-date-month">'.date("M", $event_date).'</span>';
                        $buffer = $buffer.'<span class="events-date-year">'.date("y", $event_date).'</span>';

                    // close event
                    $buffer = $buffer.'</div>';

                    // open description
                    $buffer = $buffer.'<div class="events-description">';

                        $buffer = $buffer.'<p class="events-title">'.get_the_title().'</p>';

                        // open row
                        $buffer = $buffer.'<div class="events-row">';

                            $buffer = $buffer.'<i class="events-location">'.get_field("location").'</i>';

                            if( !empty(get_field("link")) ){
                                $buffer = $buffer.'<a href="'.get_field("link").'" class="events-link">Fotos ansehen</a>';
                            }

                        $buffer = $buffer.'</div>';

                    // close description
                    $buffer = $buffer.'</div>';

                // close row
                $buffer = $buffer.'</div>';
            }

            $buffer = $buffer.'</ul>';
        } else {
            // no posts found
        }
        /* Restore original Post Data */
        wp_reset_postdata();


        return $buffer;
    }

}

//https://developer.wordpress.org/reference/functions/add_shortcode/