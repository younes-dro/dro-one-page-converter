<?php
/**
 * The header for all template except the index page 
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
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 header-container">
                        <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'dro-one-page-converter'); ?></a>
                        <header id="masthead" class="site-header">
                            <nav id="site-navigation" class="main-navigation" role="navigation">
                                <?php
                                wp_nav_menu(array(
                                    'theme_location' => 'menu-1',
                                    'menu_id' => 'primary',
                                ));
                                ?>
                            </nav><!-- #site-navigation -->
                            <?php the_custom_logo() ?>
                            <p class="custom-site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
                        </header><!-- #masthead -->
                    </div><!-- .col-12.header-container-->
                </div><!-- .row -->
                <div id="content" class="site-content row">

