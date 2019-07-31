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
                            <?php
                            // Header image is defined
                            if (get_header_image()):
                                ?>
                                <div class="site-branding header-background-image" style="background-image: url(<?php header_image() ?>)">
                                    <?php
                                    if (display_header_text()):
                                        // display title-box 
                                        echo '<div class="title-box">';
                                        ?>
                                        <h1 class="site-title"><a href="<?php esc_url(home_url("/")) ?>" rel="home"><?php bloginfo("name") ?></a></h1>
                                        <?php
                                        $dro_one_page_converter_description = get_bloginfo('description', 'display');
                                        if ($dro_one_page_converter_description || is_customize_preview()) :
                                            echo '<p class="site-description">' . $dro_one_page_converter_description . '</p>';
                                        endif;

                                        echo '</div>'; // .title-box
                                    elseif (!display_header_text()):
                                        $dro_one_page_converter_description = get_bloginfo('description', 'display');
                                        if (is_customize_preview()):
                                            echo '<div class="title-box">';
                                            ?>
                                            <h1 class="site-title"><a href="<?php esc_url(home_url("/")) ?>" rel="home"><?php bloginfo("name") ?></a></h1>
                                            <?php
                                            echo '<p class="site-description">' . $dro_one_page_converter_description . '</p>';
                                            echo '</div>'; // .title-box
                                        endif;
                                    endif;
                                    echo '</div>'; // .site-branding .header-background-image
                                endif; // get_header_image() TRUE
                                // Header text is defined and header image is not defined 
                                if (display_header_text() && !get_header_image()):
                                    echo ' <div class="site-branding text--no-header-image">';
                                    echo '<div class="title-box">';
                                    ?>
                                    <h1 class="site-title"><a href="<?php esc_url(home_url("/")) ?>" rel="home"><?php bloginfo("name") ?></a></h1>
                                    <?php
                                    $dro_one_page_converter_description = get_bloginfo('description', 'display');
                                    if ($dro_one_page_converter_description || is_customize_preview()) :
                                        echo '<p class="site-description">' . $dro_one_page_converter_description . '</p>';
                                    endif;
                                    echo '</div>'; // .title-box
                                    echo '</div>'; // .site-branding
                                endif;
                                // Header text and header image are not defined
                                if (!display_header_text() && is_customize_preview() && !get_header_image()) {
                                    echo ' <div class="site-branding no-header-image">';
                                    echo '<div class="title-box">';
                                    ?>
                                    <h1 class="site-title"><a href="<?php esc_url(home_url("/")) ?>" rel="home"><?php bloginfo("name") ?></a></h1>
                                    <?php
                                    $dro_one_page_converter_description = get_bloginfo('description', 'display');
                                    if ($dro_one_page_converter_description) :
                                        echo '<p class="site-description">' . $dro_one_page_converter_description . '</p>';
                                    endif;
                                    echo '</div>'; // .title-box
                                    echo '</div>'; // .site-branding                                    
                                }
                                ?>

                        </header><!-- #masthead -->
                    </div><!-- .col-12.header-container-->
                </div><!-- .row -->
                <div id="content" class="site-content row">

