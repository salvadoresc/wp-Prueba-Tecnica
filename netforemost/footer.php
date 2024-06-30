<footer class="container">
    <div class="row">
        <!-- Columna 4: Logo, Descripción, Redes Sociales -->
        <div class="col-md-4">
            <?php if (get_field('footer_logo', 'option')) : ?>
                <div class="footer-logo">
                    <img src="<?php echo esc_url(wp_get_attachment_image_url(get_field('footer_logo', 'option'), 'full')); ?>" alt="Logo">
                </div>
            <?php endif; ?>

            <?php if (get_field('footer_site_description', 'option')) : ?>
                <p class="footer-description normal-text">
                    <?php echo esc_html(get_field('footer_site_description', 'option')); ?>
                </p>
            <?php endif; ?>

            <div class="footer-social-networks">
                <?php
                // Obtener el campo de ACF para redes sociales
                $social_networks = get_field('footer_social_networks', 'option');

                if ($social_networks) {
                    foreach ($social_networks as $social) {
                        $image_id = isset($social['icon']) ? $social['icon'] : ''; // Obtener el ID de la imagen
                        $image_url = wp_get_attachment_image_src($image_id, 'full');

                        if ($image_url) {
                            $link = isset($social['link']['url']) ? $social['link']['url'] : ''; // Obtener el enlace de la red social
                            echo '<a href="' . esc_url($link) . '">';
                            echo '<img src="' . esc_url($image_url[0]) . '" alt="Social Icon">';
                            echo '</a>';
                        }
                    }
                }
                ?>
            </div>
        </div>

        <!-- Columnas de Navegación -->
        <?php 
        $col_count = 0;
        if (have_rows('footer_navigation', 'option')) : ?>
            <?php while (have_rows('footer_navigation', 'option')) : the_row(); ?>
                <?php if ($col_count < 4) : ?>
                    <?php if ($col_count == 0) : ?>
                      <!-- Columna vacía para balancear el diseño -->
                        <div class="col-md-2"></div>
                    <?php endif; ?>
                    <div class="col-md-2">
                        <div class="footer-nav" data-aos="fade-up">
                            <h6><?php echo esc_html(get_sub_field('nav_header')); ?></h6>
                            <?php if (have_rows('nav_links')) : ?>
                                <ul>
                                    <?php while (have_rows('nav_links')) : the_row(); ?>
                                        <li><a href="<?php echo esc_url(get_sub_field('link')['url']); ?>"><?php echo esc_html(get_sub_field('link')['title']); ?></a></li>
                                    <?php endwhile; ?>
                                </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <?php $col_count++; ?>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
    <!-- Segundo row: Copyright -->
    <div class="row">
        <div class="col-md-12">
            <?php if (get_field('footer_copyright', 'option')) : ?>
                <p class="footer-copyright">
                    <?php echo esc_html(get_field('footer_copyright', 'option')); ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
<!-- Bootstrap JS, Popper.js y jQuery (si es necesario) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
