<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package dro_one_page_converter
 */

get_header('no-branding');
?>
    <?php
        if(dro_one_page_converter_sidebar_status('sidebar-right')){
            $col_count = 'col-lg-9';
        }else{
            $col_count = 'col-lg-12';
        }
    ?>
    <div class="<?php echo $col_count?>">
	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'single' );

			the_post_navigation();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .$col -->

<?php
get_sidebar();
get_footer();
