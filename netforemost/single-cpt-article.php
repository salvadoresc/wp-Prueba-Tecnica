<?php
/**
 * Template Name: Single CPT Article
 * Template Post Type: cpt-article
 */

get_header();
?>


<section class="cpt-article">
<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <?php
                    while (have_posts()) : the_post();
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <header class="entry-header">
                                <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                            </header><!-- .entry-header -->

                            <div class="entry-content">
                                <?php
                                // Mostrar la imagen del artículo
                                $image_id = get_field('article_image');
                                if ($image_id) {
                                    echo wp_get_attachment_image($image_id, 'full', false, ['class' => 'article-image']);
                                }

                                // Mostrar el texto del artículo
                                $article_text = get_field('article_text');
                                if ($article_text) {
                                    echo '<div class="article-text"><p class="normal-text">' . $article_text . '</p></div>';
                                }

                               
                                ?>
                            </div><!-- .entry-content -->

                            
                        </article><!-- #post-<?php the_ID(); ?> -->
                    <?php endwhile; ?>
                </div><!-- .col-md-8 -->

                <div class="col-md-4">
                    <!-- Aquí puedes agregar contenido adicional, como widgets o anuncios -->
                </div><!-- .col-md-4 -->
            </div><!-- .row -->
        </div><!-- .container -->
    </main><!-- #main -->
</div><!-- #primary -->
</section>

<?php get_footer(); ?>
