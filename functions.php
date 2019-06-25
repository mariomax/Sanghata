<?php

add_action('wp_enqueue_scripts', 'enqueue_wp_child_theme');

function enqueue_wp_child_theme()
{
    wp_enqueue_style('parent-css', get_template_directory_uri() . '/style.css');

    // wp_enqueue_style('child-css', get_stylesheet_uri());
    // This is redundant and causes the child theme's stylesheet to be loaded twice!
    // The child theme's stylesheet is automatically being loaded.

    wp_enqueue_script('child-js', get_stylesheet_directory_uri() . '/js/script.js', array('jquery'), '1.0', true);
}

add_action('wp_enqueue_scripts', 'custom_add_google_fonts');

function custom_add_google_fonts()
{
    wp_enqueue_style('custom-google-fonts', 'https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,900&display=swap', false);
}
