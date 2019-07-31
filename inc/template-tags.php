<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package dro_one_page_converter
 */
if (!function_exists('dro_one_page_converter_posted_on')) :

    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function dro_one_page_converter_posted_on() {
        $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
        if (get_the_time('U') !== get_the_modified_time('U')) {
            $time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
        }

        $time_string = sprintf($time_string, esc_attr(get_the_date(DATE_W3C)), esc_html(get_the_date()), esc_attr(get_the_modified_date(DATE_W3C)), esc_html(get_the_modified_date())
        );

        $posted_on = sprintf(
                '%s', $time_string);


        echo '<span class="posted-on">' . __('<i class="fa fa-calendar" aria-hidden="true"></i>', 'dro-one-page-converter') . $posted_on . '</span>'; // WPCS: XSS OK.
    }

endif;

if (!function_exists('dro_one_page_converter_posted_by')) :

    /**
     * Prints HTML with meta information for the current author.
     */
    function dro_one_page_converter_posted_by() {
        $byline = sprintf(
                
                '%s', '<span class="author vcard"><i class="fa fa-user"></i><a class="url fn n" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>'
        );

        echo '<span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.
    }

endif;

if (!function_exists('dro_one_page_converter_entry_footer')) :

    /**
     * Prints HTML with meta information for the categories, tags and comments.
     */
    function dro_one_page_converter_entry_footer() {
        // Hide category and tag text for pages.
        if ('post' === get_post_type()) {
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list(esc_html__(', ', 'dro-one-page-converter'));
            if ($categories_list) {
                /* translators: 1: list of categories. */
                printf(
                        '<span class="cat-links"><span class="posted-in">' . esc_html__('Posted in : ', 'dro-one-page-converter') . '</span>%1$s</span>', 
                        $categories_list); // WPCS: XSS OK.
            }


            $tags_list = get_the_tag_list();
            if ($tags_list) {
                
                printf('<span class="tags-links">%1$s</span>', $tags_list); 
            }
        }

        if (!is_single() && !post_password_required() && ( comments_open() || get_comments_number() )) {
            echo '<span class="comments-link">';
            comments_popup_link(
                    sprintf(
                            wp_kses(
                                    /* translators: %s: post title */
                                    __('Leave a Comment<span class="screen-reader-text"> on %s</span>', 'dro-one-page-converter'), array(
                'span' => array(
                    'class' => array(),
                ),
                                    )
                            ), the_title_attribute(array('echo'=> FALSE))
                    )
            );
            echo '</span>';
        }

        edit_post_link(
                sprintf(
                        wp_kses(
                                /* translators: %s: Name of current post. Only visible to screen readers */
                                __('Edit <span class="screen-reader-text">%s</span>', 'dro-one-page-converter'), array(
            'span' => array(
                'class' => array(),
            ),
                                )
                        ), the_title_attribute(array('echo' => FALSE))
                ), '<span class="edit-link">', '</span>'
        );
    }

endif;
if(!function_exists('dro_one_page_converter_single_entry_footer')){
    
    /**
     * Prints HTML with meta information for the categories, tags for single post.
     */
    function dro_one_page_converter_single_entry_footer(){
            /* translators: used between list items, there is a space after the comma */
            $categories_list = get_the_category_list(esc_html__(', ', 'dro-one-page-converter'));
            if ($categories_list) {
                /* translators: 1: list of categories. */
                printf(
                        '<span class="cat-links"><span class="posted-in">' . esc_html__('Posted in : ', 'dro-one-page-converter') . '</span>%1$s</span>', 
                        $categories_list); // WPCS: XSS OK.
            }

            
            $tags_list = get_the_tag_list();
            if ($tags_list) {
                
                printf('<span class="tags-links">%1$s</span>', $tags_list); 
            }        
    }
}

if (!function_exists('dro_one_page_converter_post_thumbnail')) :

    /**
     * Displays an optional post thumbnail.
     *
     * Wraps the post thumbnail in an anchor element on index views, or a div
     * element when on single views.
     */
    function dro_one_page_converter_post_thumbnail() {
        if (post_password_required() || is_attachment() || !has_post_thumbnail()) {
            return;
        }

        if (is_singular()) :
            ?>

            <div class="post-thumbnail">
            <?php the_post_thumbnail(); ?>
            </div><!-- .post-thumbnail -->

            <?php else : ?>

            <a class="post-thumbnail" title="<?php the_title_attribute() ?>" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
            <?php
            the_post_thumbnail('post-thumbnail', array(
                'alt' => the_title_attribute(array(
                    'echo' => false,
                )),
            ));
            ?>
            </a>

            <?php
            endif; // End is_singular().
        }


endif;

if (!function_exists('dro_one_page_converter_posts_pagination')):

    /**
     * Display Posts pagination  : Index and Archive pages
     */
    function dro_one_page_converter_posts_pagination() {

        the_posts_pagination(array(
            'prev_text' => '<span><i class="fa fa-arrow-left"></i></span>',
            'next_text' => '<span><i class="fa fa-arrow-right"></i></span>'
        ));
    }

endif;
