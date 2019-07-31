<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
  <?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package dro_one_page_converter
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses dro_one_page_converter_header_style()
 */
function dro_one_page_converter_custom_header_setup() {
    add_theme_support('custom-header', apply_filters('dro_one_page_converter_custom_header_args', array(
        'default-image' => get_template_directory_uri() . '/assets/images/dro-one-page-converter-header.png',
        'default-text-color' => '#9e2520',
        'width' => 2000,
        'height' => 1200,
        'flex-height' => false, // desable very large image height
        'wp-head-callback' => 'dro_one_page_converter_header_style',
    )));
}

add_action('after_setup_theme', 'dro_one_page_converter_custom_header_setup');

if (!function_exists('dro_one_page_converter_header_style')) :

    /**
     * Styles the header image and text displayed on the blog.
     *
     * @see dro_one_page_converter_custom_header_setup().
     */
    function dro_one_page_converter_header_style() {
        $header_text_color = get_header_textcolor();

        /*
         * If no custom options for text are set, let's bail.
         * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
         */
        if (get_theme_support('custom-header', 'default-text-color') === $header_text_color) {
            return;
        }

        // If we get this far, we have custom styles. Let's do this.
        ?>
        <style type="text/css">
        <?php
// Has the text been hidden?
        if (!display_header_text()) :
            ?>
                .title-box {
                    position: absolute;
                    clip: rect(1px, 1px, 1px, 1px);
                }
            <?php
// If the user has set a custom color for the text use that.
        else :
            ?>
                .site-title a,
                p.site-description {
                    color: #<?php echo esc_attr($header_text_color); ?>;
                }
        <?php endif; ?>
        </style>
        <?php
    }

endif;


if (!function_exists('dro_one_page_converter_custom_logo()')) {

    /**
     * Styles the custom logo
     * 
     * @return string
     */
    function dro_one_page_converter_custom_logo() {
        
        // output
        $html = "";
        // The logo
        $custom_logo_id = get_theme_mod('custom_logo');
        
        // If has logo
        if ($custom_logo_id) {

            // Attr
            $custom_logo_attr = array(
                'class' => 'custom-logo ',
                'itemprop' => 'logo',
            );

            // Image alt
            $image_alt = get_post_meta($custom_logo_id, '_wp_attachment_image_alt', true);
            if (empty($image_alt)) {
                $custom_logo_attr['alt'] = get_bloginfo('name', 'display');
            }

            // Get the image
            $html = sprintf('<a href="' . esc_url(home_url()) . '"'
                    . 'class="custom-logo-link" rel="home" itemprop="url">%1$s</a>', wp_get_attachment_image($custom_logo_id, 'full', false, $custom_logo_attr)
            );
        }

        // Return
        return $html;
    }

}
add_filter('get_custom_logo', 'dro_one_page_converter_custom_logo');
