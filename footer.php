<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package dro_one_page_converter
 */
?>
<h1>end row </h1>
</div><!-- .row -->
</div><!-- .container-fluid -->

</div><!-- #content -->

<footer id="colophon" class="site-footer">
    <div class="site-info">
        <a href="<?php echo esc_url(__('https://wordpress.org/', 'dro-one-page-converter')); ?>">
            <?php
            /* translators: %s: CMS name, i.e. WordPress. */
            printf(esc_html__('Proudly powered by %s', 'dro-one-page-converter'), 'WordPress');
            ?>
        </a>
        <span class="sep"> | </span>
        <?php
        /* translators: 1: Theme name, 2: Theme author. */
        printf(esc_html__('Theme: %1$s by %2$s.', 'dro-one-page-converter'), 'dro-one-page-converter', '<a href="' . esc_url(__("http://www.dro.123.fr", "dro-one-page-converter")) . '">Younes DRO</a>');
        ?>
    </div><!-- .site-info -->
</footer><!-- #colophon -->
</div>
</div>
</div><!-- .container-fluid or container (full width option )-->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
