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
                    if ($dro_one_page_converter_frontpage->frontpage_content() === false) {
                        echo '<div class="alert alert-danger">' .
                        esc_html__('Your Front Page does not have any child pages. Nothing to show !', 'dro-one-page-converter')
                        . '</div>';
                    } else {
                        $allowed_html = array( 
                            'section' => array(
                                'class' => array(),
                                'id' => array()
                            ),
                            'div' => array(
                                'class' => array(),
                                'style' => array()
                            ),
                            'h1' => array(
                                'class'=>array()
                            ),
                            'img' => array(
                                'src' => array(),
                                'class' => array()
                            ),
                            'a' => array(
                                'href' => array(),
                                'title' => array(),
                                'class' => array()
                            )
                            ); 
                        
                        echo wp_kses($dro_one_page_converter_frontpage->content, $allowed_html);
                    }
                    ?>
                </main><!-- #main -->
            </div><!-- #primary -->
        </div><!-- .col-12 -->
    </div><!-- .row -->
    <?php
    get_template_part('one-page/footer-onepage');


    