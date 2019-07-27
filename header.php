<?php
/**
 * The header for our theme
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
                    <?php if (get_header_image() && !display_header_text()) : ?>
                        <div id="header-image" class="header-image">
                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                                <img src="<?php header_image(); ?>"
                                     width="<?php echo absint(get_custom_header()->width); ?>" 
                                     height="<?php echo absint(get_custom_header()->height); ?>"
                                     alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>">
                            </a>
                        </div>
                    <?php endif; ?>
                    <?php if (get_header_image() && display_header_text()): ?>
                        <div class="site-branding header-background-image" style="background-image: url(<?php header_image() ?>)">
                        <?php else: ?>
                            <div class="site-branding">
                            <?php endif; ?>
                            <div class="title-box">
                                <?php
                                if (is_front_page() && is_home()) :
                                    ?>
                                    <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                                    <?php
                                else :
                                    ?>
                                    <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
                                <?php
                                endif;
                                $dro_one_page_converter_description = get_bloginfo('description', 'display');
                                if ($dro_one_page_converter_description || is_customize_preview()) :
                                    ?>
                                    <p class="site-description"><?php echo $dro_one_page_converter_description; /* WPCS: xss ok. */ ?></p>
                                <?php endif; ?>
                            </div><!-- .title-box -->
                        </div><!-- .site-branding -->

                </header><!-- #masthead -->
                </div><!-- .col-12.header-container-->
                </div><!-- .row -->
                <div id="content" class="site-content row">
                        
