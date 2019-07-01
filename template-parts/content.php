<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package dro_one_page_converter
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="article-inner-wrapper">
        <header class="entry-header">
            <?php
            if (is_sticky() && !is_paged() && is_front_page()) {
                echo '<i class="fa fa-thumb-tack post-sticky"></i>';
            }
            ?>            
            <?php
            if (is_singular()) :
                the_title('<h1 class="entry-title">', '</h1>');
            else :
                the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
            endif;

            if ('post' === get_post_type()) :
                ?>
                <div class="entry-meta">
                    <?php
                    dro_one_page_converter_posted_on();
                    dro_one_page_converter_posted_by();
                    ?>
                </div><!-- .entry-meta -->
            <?php endif; ?>
        </header><!-- .entry-header -->

        <?php dro_one_page_converter_post_thumbnail(); ?>

        <div class="entry-content">
            <?php
            the_content(sprintf(
                            wp_kses(
                                    /* translators: %s: Name of current post. Only visible to screen readers */
                                    __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'dro-one-page-converter'), array(
                'span' => array(
                    'class' => array(),
                ),
                                    )
                            ), get_the_title()
            ));

            wp_link_pages(array(
                'before' => '<div class="page-links">' . esc_html__('Pages:', 'dro-one-page-converter'),
                'after' => '</div>',
            ));
            ?>
        </div><!-- .entry-content -->

        <footer class="entry-footer">
<?php dro_one_page_converter_entry_footer(); ?>
        </footer><!-- .entry-footer -->
    </div><!-- .article-inner-wrapper -->
</article><!-- #post-<?php the_ID(); ?> -->