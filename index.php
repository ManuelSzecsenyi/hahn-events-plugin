<?php

/*
Plugin Name: Hahn Events
Description: A custom wordpress plugin which displays events
Author: Manuel Szecsenyi
Version: 0.1
Author URI: http://marginleft.at
*/


// Register Custom Post Type
function register_hahn_event() {

    $labels = array(
        'name'                  => _x( 'Events', 'Post Type General Name', 'hahn_event' ),
        'singular_name'         => _x( 'Event', 'Post Type Singular Name', 'hahn_event' ),
        'menu_name'             => __( 'Events', 'hahn_event' ),
        'name_admin_bar'        => __( 'Event', 'hahn_event' ),
        'archives'              => __( 'Event Archiv', 'hahn_event' ),
        'attributes'            => __( 'Event Attribute', 'hahn_event' ),
        'parent_item_colon'     => __( 'Parent Item:', 'hahn_event' ),
        'all_items'             => __( 'Alle Events', 'hahn_event' ),
        'add_new_item'          => __( 'Event hinzufügen', 'hahn_event' ),
        'add_new'               => __( 'Hinzufügen', 'hahn_event' ),
        'new_item'              => __( 'Neues Event', 'hahn_event' ),
        'edit_item'             => __( 'Event bearbeiten', 'hahn_event' ),
        'update_item'           => __( 'Event aktualisieren', 'hahn_event' ),
        'view_item'             => __( 'Event ansehen', 'hahn_event' ),
        'view_items'            => __( 'Events ansehen', 'hahn_event' ),
        'search_items'          => __( 'Event suchen', 'hahn_event' ),
        'not_found'             => __( 'Nicht gefunden', 'hahn_event' ),
        'not_found_in_trash'    => __( 'Nicht im Papierkorb gefunden', 'hahn_event' ),
        'featured_image'        => __( 'Featured Image', 'hahn_event' ),
        'set_featured_image'    => __( 'Set featured image', 'hahn_event' ),
        'remove_featured_image' => __( 'Remove featured image', 'hahn_event' ),
        'use_featured_image'    => __( 'Use as featured image', 'hahn_event' ),
        'insert_into_item'      => __( 'Insert into item', 'hahn_event' ),
        'uploaded_to_this_item' => __( 'Uploaded to this item', 'hahn_event' ),
        'items_list'            => __( 'Items list', 'hahn_event' ),
        'items_list_navigation' => __( 'Items list navigation', 'hahn_event' ),
        'filter_items_list'     => __( 'Filter items list', 'hahn_event' ),
    );
    $args = array(
        'label'                 => __( 'Event', 'hahn_event' ),
        'description'           => __( 'Hahn Veranstaltungen', 'hahn_event' ),
        'labels'                => $labels,
        'supports'              => array( 'title'),
        'hierarchical'          => false,
        'public'                => true,
        'show_ui'               => true,
        'show_in_menu'          => true,
        'menu_position'         => 5,
        'show_in_admin_bar'     => true,
        'show_in_nav_menus'     => true,
        'can_export'            => true,
        'has_archive'           => true,
        'exclude_from_search'   => false,
        'publicly_queryable'    => true,
        'capability_type'       => 'page',
        'menu_icon'             => 'dashicons-megaphone',
    );
    register_post_type( 'event', $args );

}
add_action( 'init', 'register_hahn_event', 0 );


// Define path and URL to the ACF plugin.
define( 'MY_ACF_PATH', plugin_dir_path(__FILE__) . '/includes/acf/' );
define( 'MY_ACF_URL', plugin_dir_url(__FILE__) . '/includes/acf/' );

// Include the ACF plugin.
include_once( MY_ACF_PATH . 'acf.php' );

// Customize the url setting to fix incorrect asset URLs.
add_filter('acf/settings/url', 'my_acf_settings_url');
function my_acf_settings_url( $url ) {
    return MY_ACF_URL;
}

// (Optional) Hide the ACF admin menu item.
add_filter('acf/settings/show_admin', 'my_acf_settings_show_admin');
function my_acf_settings_show_admin( $show_admin ) {
    return true;
}

/**
 * ACF Fields
 */
if( function_exists('acf_add_local_field_group') ):

    acf_add_local_field_group(array(
        'key' => 'group_5f3659c3e3af3',
        'title' => 'Hahn-Event',
        'fields' => array(
            array(
                'key' => 'field_5f3659ce213ce',
                'label' => 'Location',
                'name' => 'location',
                'type' => 'text',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
            ),
            array(
                'key' => 'field_5f3659dc213cf',
                'label' => 'Datum',
                'name' => 'date',
                'type' => 'date_picker',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'display_format' => 'd/m/Y',
                'return_format' => 'Ymd',
                'first_day' => 1,
            ),
            array(
                'key' => 'field_5f365a2c213d0',
                'label' => 'Link',
                'name' => 'link',
                'type' => 'link',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'url',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'event',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));

endif;