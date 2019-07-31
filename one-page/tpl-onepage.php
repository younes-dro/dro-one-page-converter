<?php
/*
 * Template Name: Dro OnePage Converter
 *
 * @package dro_one_page_converter
 */

// Create the Front Page Object 

$dro_one_page_converter_frontpage = new dro_one_page_converter_frontpage(get_the_ID());

if ($dro_one_page_converter_frontpage->has_child === 0) {
    get_template_part('one-page/header-none');
} else {
    get_template_part('one-page/header-onepage');
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div id="primary" class="content-area">
                <main id="main" class="site-main">
                    <?php
                    if ($dro_one_page_converter_frontpage->frontpage_content() === false ) {
                        echo '<div class="alert alert-danger">' .
                        esc_html__('Your Front Page does not have any child pages. Nothing to show !', 'dro-one-page-converter')
                        . '</div>';
                    } else {
                        echo ( $dro_one_page_converter_frontpage->content);
                    }
                    ?>
                </main><!-- #main -->
            </div><!-- #primary -->
        </div><!-- .col-12 -->
    </div><!-- .row -->
<?php
get_template_part('one-page/footer-onepage');


