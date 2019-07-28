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
    <!--<div class="article-inner-wrapper">-->
        <header class="entry-header col-lg-3">
            <?php
            if (is_sticky() && !is_paged() && is_front_page()) {
                echo '<i class="fa fa-thumb-tack post-sticky"></i>';
            }
            ?>            
            <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
                <div class="entry-meta">
                    <?php
                    dro_one_page_converter_posted_on();
                    dro_one_page_converter_posted_by();
                    ?>
                </div><!-- .entry-meta -->
                <footer class="cat-tags-single-post">
                    <?php dro_one_page_converter_single_entry_footer(); ?>
                </footer><!-- .entry-footer -->
        </header><!-- .entry-header -->
        <div class="col-lg-9">
        <?php dro_one_page_converter_post_thumbnail(); ?>

        <div class="entry-content">
            <?php the_content() ?>
        </div><!-- .entry-content -->
        </div><!-- .col-md-9 -->
    <!-- .article-inner-wrapper -->
</article><!-- #post-<?php the_ID(); ?> -->
