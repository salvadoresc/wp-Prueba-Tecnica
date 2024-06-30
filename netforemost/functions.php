<?php
// Función para registrar estilos y scripts
function my_theme_enqueue_styles() {
    // Registrar estilos de Bootstrap desde CDN
    wp_enqueue_style('bootstrap-css', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css', array(), '4.5.2', 'all');
    
    // Registrar estilos del tema hijo (style.css)
    wp_enqueue_style('child-theme-css', get_stylesheet_uri(), array('bootstrap-css'), wp_get_theme()->get('Version'));
    
    // Registrar script de Bootstrap y dependencias (Popper.js y jQuery)
    wp_enqueue_script('bootstrap-js', 'https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js', array('jquery', 'popper-js'), '4.5.2', true);


    // Registrar Google Fonts - Spartan y Mulish
    wp_enqueue_style('google-fonts-spartan', 'https://fonts.googleapis.com/css2?family=Spartan:wght@600&display=swap', array(), null);
    wp_enqueue_style('google-fonts-mulish', 'https://fonts.googleapis.com/css2?family=Mulish&display=swap', array(), null);

    //custom css
    wp_enqueue_style('custom-css', get_template_directory_uri() . '/inc/assets/css/custom-styles.css', array(), filemtime(get_template_directory() . '/inc/assets/css/custom-styles.css'));

    // custom.js
    wp_enqueue_script('custom-js', get_stylesheet_directory_uri() . '/inc/assets/js/custom.js', array(), filemtime(get_stylesheet_directory() . '/inc/assets/js/custom.js'), true);

    // Enqueue AOS CSS
    wp_enqueue_style('aos-css', 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css', array(), '2.3.4', 'all');

    // Enqueue AOS JavaScript
    wp_enqueue_script('aos-js', 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js', array('jquery'), '2.3.4', true);

    //custom esc end

    // Incluye Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css', array(), '5.15.4', 'all');
}
add_action('wp_enqueue_scripts', 'my_theme_enqueue_styles');

// Registro de menús
function register_my_menus() {
    register_nav_menus(
        array(
            'primary' => __('Primary Menu'),
        )
    );
}
add_action('init', 'register_my_menus');

// Incluir clase Walker para el menú de Bootstrap si es necesario
require_once get_template_directory() . '/inc/bootstrap-navwalker.php';



if( function_exists('acf_add_options_page') ) {
    
    acf_add_options_page(array(
        'page_title'    => 'Theme General Settings',
        'menu_title'    => 'Theme Settings',
        'menu_slug'     => 'theme-general-settings',
        'capability'    => 'edit_posts',
        'redirect'      => false
    ));
    
    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Header Settings',
        'menu_title'    => 'Header',
        'parent_slug'   => 'theme-general-settings',
    ));
    
    acf_add_options_sub_page(array(
        'page_title'    => 'Theme Footer Settings',
        'menu_title'    => 'Footer',
        'parent_slug'   => 'theme-general-settings',
    ));

    
    
}


function move_yoast_below_acf() {
    return 'low';
}
add_filter( 'wpseo_metabox_prio', 'move_yoast_below_acf');