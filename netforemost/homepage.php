<?php
/**
 * Template Name: salvadoresc-homepage
 */

get_header();
?>

<!-- Contenido principal aquí -->

<section class="hero-banner" data-aos="fade-up">
    <div class="banner-container">
        <div class="row">
            <div class="col-xl-4 col-lg-6 col-sm-12">
                <!-- Contenido izquierdo del banner -->
                <span class="hero-label"><?php echo get_field('hero_label'); ?></span>
                <h2 class="hero-heading"><?php echo get_field('hero_heading'); ?></h2>
                <p class="large-text hero-content"><?php echo get_field('hero_content'); ?></p>
            </div>
            <div class="col-xl-8 col-lg-6 col-sm-12">
                <!-- Imagen del banner -->
                <?php
                $image_id = get_field('hero_image');
                $image_url = wp_get_attachment_image_url($image_id, 'full');
                ?>
                <img src="<?php echo esc_url($image_url); ?>" class="img-fluid" alt="Hero Image">
            </div>
        </div>
    </div>
</section>





<section class="cpt-articles">
    <div class="container">
    	<?php
        // Obtener el valor del campo ACF 'articlescpt_heading'
        $articlescpt_heading = get_field('articlescpt_heading');

        // Mostrar el encabezado solo si hay contenido en el campo
        if ($articlescpt_heading) :
        ?>
            <div class="row">
                <div class="col-12">
                    <h3 data-aos="fade-down"><?php echo esc_html($articlescpt_heading); ?></h3>
                </div>
            </div>
        <?php endif; ?>
        <div class="row">
            <?php
            $args = array(
                'post_type' => 'cpt-article',
                'posts_per_page' => 3, // Cambia según tu necesidad
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
            ?>
                    <div class="col-xl-4 col-lg-12 article-item" data-aos="fade-up" data-aos-once="false">
                        <?php if (get_field('article_image')) : ?>
                            <img src="<?php echo esc_url(wp_get_attachment_image_src(get_field('article_image'), 'full')[0]); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                        <?php endif; ?>

                        <h4><?php echo esc_html(get_the_title()); ?></h4>

                        <?php if (get_field('article_text')) : ?>
                            <p class="normal-text"><?php echo esc_html(get_field('article_text')); ?></p>
                        <?php endif; ?>

                        <?php if (get_field('article_link')) : ?>
                            <a href="<?php echo esc_url(get_field('article_link')['url']); ?>" class="button-post"><?php echo esc_html(get_field('article_link')['title']); ?></a>
                        <?php endif; ?>
                    </div>
            <?php
                endwhile;
                wp_reset_postdata();
            else :
                // No se encontraron artículos
            endif;
            ?>

        </div>
    </div>
</section>



<!-- posts -->

<section class="custom-posts">
    <div class="container">
        <?php if (get_field('articles_heading')) : ?>
            <h3 data-aos="fade-down"><?php echo esc_html(get_field('articles_heading')); ?></h3>
        <?php endif; ?>

        <div class="row articles-list">
            <?php
            $args = array(
                'post_type' => 'post',
                'posts_per_page' => 4, // Cambia esto según cuántos posts quieras mostrar
            );

            $query = new WP_Query($args);

            if ($query->have_posts()) :
                while ($query->have_posts()) : $query->the_post();
            ?>

                    <div class="col-xl-6 col-lg-12" data-aos="fade-up" data-aos-once="false">
                        <div class="post-item">
                            <div class="post-image-wrapper">
                                <?php
                                // Mostrar la imagen del post desde el contenido
                                $content = apply_filters('the_content', get_the_content());
                                $doc = new DOMDocument();
                                libxml_use_internal_errors(true);
                                $doc->loadHTML(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'));

                                $images = $doc->getElementsByTagName('img');
                                if ($images->length > 0) {
                                    $img_src = $images->item(0)->getAttribute('src');
                                    echo '<img src="' . esc_url($img_src) . '" alt="Post Image" class="post-image">';
                                }
                                ?>
                            </div>

                            <div class="post-details">
                                <span class="category-label"><?php the_category(', '); ?></span>
                                <h4><?php the_title(); ?></h4>
                                <p class="extra-small-text">
                                    <span class="post-date">Added: <?php echo get_the_date('F j, Y'); ?></span>
                                    <span class="post-comments"><i class="far fa-comment"></i> <?php echo get_comments_number(); ?></span>
                                </p>
                                <p class="normal-text"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                                <div class="author-info">
                                    <?php echo get_avatar(get_the_author_meta('ID'), 32); ?>
                                    <span class="author-name"><?php the_author(); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>

            <?php
                endwhile;
                wp_reset_postdata();
            else :
                echo '<p>No hay posts encontrados.</p>';
            endif;
            ?>
        </div>
    </div>
</section>





<section class="about-us"  data-aos="fade-left">
    <div class="container">
        <div class="row">
            <div class="col-xl-5 col-lg-12 about-image">
                <?php
                $about_image_id = get_field('about_image');
                if ($about_image_id) {
                    echo wp_get_attachment_image($about_image_id, 'full', false, array('alt' => 'About Us Image'));
                }
                ?>
            </div>
            <div class="col-xl-7  col-lg-12 about-content">
                <div class="about-box">
                    <?php
                    $about_title = get_field('about_title');
                    $about_heading = get_field('about_heading');
                    $about_text = get_field('about_text');
                    $about_cta = get_field('about_cta');

                    if ($about_title) {
                        echo '<p class="text-large">' . esc_html($about_title) . '</p>';
                    }

                    if ($about_heading) {
                        echo '<h2>' . esc_html($about_heading) . '</h2>';
                    }

                    if ($about_text) {
                        echo '<p class="text-large">' . esc_html($about_text) . '</p>';
                    }

                    if ($about_cta) {
                        echo '<a href="' . esc_url($about_cta['url']) . '" class="cta-button">' . esc_html($about_cta['title']) . '</a>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>





<section class="newsletter" data-aos="fade-right">
    <div class="container">
        <div class="newsletter-content">
            <?php echo do_shortcode('[gravityform id="1" title="false" description="false" ajax="true"]'); ?>
        </div>
    </div>
</section>


<?php get_footer(); ?>