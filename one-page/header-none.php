<?php
/**
 * The header for the One Page if no child pages was found
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package dro_one_page_converter
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo('charset'); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="profile" href="https://gmpg.org/xfn/11">

        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?>>
        <div id="page" class="site">
            <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'dro-one-page-converter'); ?></a>
            <header id="masthead" class="site-header">

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="navbar navbar-inverse ">
                                <div class="navbar-inner">
                                    <nav id="site-navigation" class="main-navigation front-page-navigation sticky-active" role="navigation">
                                    </nav><!-- #site-navigation -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php the_custom_logo() ?>
            </header><!-- #masthead -->
            <div id="content" class="site-content">
    
