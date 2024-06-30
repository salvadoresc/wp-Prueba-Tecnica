<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php wp_title('|', true, 'right'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light" data-aos="flip-up">
         <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
            <?php
            // Obtener la ID del logo desde la página de opciones
            $logo_id = get_field('header_logo', 'option');
            // Obtener la URL de la imagen del logo
            $logo_url = wp_get_attachment_image_url($logo_id, 'full');

            if ($logo_url) {
                // Mostrar la imagen del logo
                echo '<img src="' . esc_url($logo_url) . '" alt="' . get_bloginfo('name') . ' Logo">';
            } else {
                // Mostrar el nombre del sitio si no hay logo
                echo get_bloginfo('name');
            }
            ?>
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Menú generado automáticamente -->
            <?php
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class'     => 'navbar-nav ml-auto',
                    'fallback_cb'    => '__return_false',
                    'items_wrap'     => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'depth'          => 2,
                    'walker'         => new WP_Bootstrap_Navwalker(),
                ));
            ?>
            <!-- Icono de búsqueda -->
                <form class="form-inline my-2 my-lg-0 ml-3" id="search-header">
                    <button class="btn my-2 my-sm-0" type="submit">
                        <i class="fas fa-search"></i> 
                    </button>
                </form>
        </div>
    </nav>

    <div class="container">
        <!-- Contenido de la cabecera -->
    </div>