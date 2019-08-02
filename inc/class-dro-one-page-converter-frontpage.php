<?php

/**
 * 
 * This Class generate the menu and the content for the front page 
 *
 * @author Younés DRO <younesdro@gmail.com>
 * @version 1.0.0
 * @since 1.0.0
 */
class dro_one_page_converter_frontpage {

    /**
     *
     * @var int $parant_page
     */
    public $parent_page;

    /**
     *
     * @var boolean 
     */
    public $has_child;

    /**
     * 
     * @var array 
     */
    private $pages;

    /**
     * The navigation menu parameters.
     * 
     * @var type array The Menu Parameters
     */
    public $menu_attributes = array(
        'menu_class' => 'front-page-nav-menu',
    );

    /**
     * The tags HTML content parameters.
     * Unused for now .
     * 
     * @var array The Content Parameters
     */
    public $content_attributes = array(
        'wrapper_html_tag' => '',
        'wrapper_class' => '',
    );

    /**
     * HTML navigation menu
     * 
     * @var string $menu 
     */
    private $menu;

    /**
     * HTML content 
     * 
     * @var string $content 
     */
    public $content;

    /**
     * Constructor
     * 
     * @param int $id The ID of the parent page.
     */
    public function __construct($id = '') {

        $this->parent_page = $id;
        $this->_get_pages();
        $this->_has_child();
    }

    /**
     * Verfiy if the main page has a children pages or not
     * minimum one child 
     *
     * @return int 
     */
    private function _has_child() {

        return $this->has_child = count($this->pages);
    }

    /**
     * Retreive the child pages.
     * 
     */
    private function _get_pages() {
        $this->pages = get_pages(array(
            'child_of' => $this->parent_page,
            'parent' => $this->parent_page,
            'post_status' => 'publish'
        ));
    }

    /**
     * Combine user attributes with known attributes and fill in defaults when needed.
     * 
     * @param array $pairs Entire list of supported attributes and their defaults.
     * @param array $atts  User defined attributes.
     * @return array Combined and filtered attribute list. 
     */
    private function _merge_menu_attributes($pairs, $atts) {
        $atts = (array) $atts;
        $out = array();
        foreach ($pairs as $name => $default) {
            if (array_key_exists($name, $atts)) {
                $out[$name] = $atts[$name];
            } else {
                $out[$name] = $default;
            }
        }

        return $out;
    }

    /**
     * Build the menu.
     * 
     * @param array $pages
     * 
     * @return string The HTML menu output
     */
    private function _construct_menu(array $pages) {
        extract($this->menu_attributes);
        $this->menu = '<ul class="' . $menu_class . '">';
        foreach ($pages as $key => $value) {
            $this->menu .='<li>';
            $this->menu .='<a href="#' 
                    . esc_attr($pages[$key]->post_name) 
                    . '" title="' .
                    esc_attr($pages[$key]->post_title) . '">' .
                    esc_attr($pages[$key]->post_title) . '</a>';
            $this->menu .='</li>';
        }
        $this->menu .="</ul>";

        return $this->menu;
    }

    /**
     * Display the navigation menu 
     * 
     * @param array $menu_attributes The menu parameters.
     */
    public function frontpage_nav_menu($menu_attributes = array()) {
        $this->menu_attributes = $this->_merge_menu_attributes($this->menu_attributes, $menu_attributes);
        echo $this->_construct_menu($this->pages);
    }

    /**
     * Retrieve all the content of the front page
     * or false , if no child page was found
     * 
     * @return string|false The html output or false
     */
    public function frontpage_content() {

        if ($this->pages) {
            $this->_construct_content($this->pages);
            return $this->content;
        } else {
            return false;
        }
    }

    /**
     * Return the contents of the child pages,
     * 
     * @param array $pages
     * @return string
     */
    private function _construct_content(array $pages) {


        foreach ($pages as $page) {

            /*
             * Retrieve the featured image (if exists)  and set it as background of the section.
             */

            $featured_image = '';
            $class_has_not_thumbnail = '';

            if (has_post_thumbnail($page->ID)) {

                $featured_image_url = get_the_post_thumbnail_url(($page->ID));
                $featured_image = ' <img class="featured-image img-fluid" src="' . esc_url($featured_image_url) . '" />';
            } else {
                $class_has_not_thumbnail = 'has-not-thumbnail';
            }
            $content_parts = get_extended($page->post_content);
            $trans = '<div class="trans"></div>';
            // If the child page has a children too
            if ($this->_subpage_has_child($page->ID) > 0) {
                $this->content .= '<section id="' . esc_attr($page->post_name) . '" class="element page-has-child" >'
                        .$featured_image
                        . $trans
                        . '<div class="container-fluid">'
                        . '<div class="row">'
                        . '<div class="col-lg-12">'
                        . '<h1 class="entry-title section-title section-title-has-child">'
                        . esc_html($page->post_title)
                        . '</h1>'
                        . '<div class="entry-content entry-content-has-child">' . $content_parts['main'] . '</div>'
                        . $this->_more_tag_link($page->ID)
                        . '</div><!-- .col-lg-12-->'
                        . '<div class="col-lg-12 children-pages">'
                        . '<div class="row justify-content-center">'
                        . $this->_subpage_content($page->ID)
                        . '</div><!-- .row (child ) -->'
                        . '</div><!-- .col-lg-12 (child) -->'
                        . '</div><!-- .row (parent) -->'
                        . '</div><!-- .content-fluid (parent) -->';
                $this->content .='</section>';
            } else {
                $this->content .= '<section id="' . esc_attr($page->post_name) . '" '
                        . 'class="element ' . $class_has_not_thumbnail . '">'
                        .$featured_image
                        . $trans
                        . '<div class="container-fluid">'
                        . '<div class="row">'
                        . '<div class="col-lg-5">'
                        . '<h1 class="entry-title section-title">' . esc_html($page->post_title) . '</h1>'
                        . '</div><!-- .col-lg-5 -->'
                        . '<div class="col-lg-7">'
                        . '<div class="entry-content">'
                        // Display the text before the more tag
                        . $content_parts['main']
                        . $this->_more_tag_link($page->ID)
                        . '</div><!-- .entry-content -->'
                        . '</div><!-- .col-lg-7 -->'
                        . '</div><!-- .row -->'
                        . '</div><!-- .content-fluid -->';
                $this->content .='</section>';
            }
        }

        return $this->content;
    }

    /**
     * Display the more tag link.
     * 
     * @param int $id the page ID
     * @return string the more tag link
     */
    private function _more_tag_link($id) {
        return '<h2><a class="read-more" '
                . 'title="' . esc_attr('Read More', 'dro-one-page-converter')
                . '" href="' . esc_url(get_page_link($id) . '#post-' . $id ). '">[...]</a></h2>';
    }

    /**
     * Verfy if a child page has children too
     * 
     * @param int $id the page ID
     */
    private function _subpage_has_child($id) {
        return count(get_pages(array(
            'child_of' => $id,
            'parent' => $id
        )));
    }

    /**
     * Retreive the content of the subpages  only the first level elements
     * 
     * @param int $id
     * @return string the title and the content of the subpages
     */
    private function _subpage_content($id) {
        $out = '';
        $subpages = new WP_Query(array(
            'post_type' => 'page',
            'post_parent' => $id,
            'orderby' => 'rand'
        ));
        while ($subpages->have_posts()):
            $subpages->the_post();
            $out .= '<div class="col-md-4  child-element">';
            $out .= '<div class="child-element-wrapper">';
            $out .= '<div class="row">';
            $out .= ''
                    . '<div class="col-12">'
                    . '<h1 class="entry-title">' . the_title_attribute(array('echo' => false)) . '</h1>'
                    . $this->_more_tag_link(get_the_ID())
                    . '</div><!-- .col-12 -->'
                    . '';
            if (has_post_thumbnail()) {
                $out .= ''
                        . ''
                        . '<div class="col-12">'
                        . '<img src="' . esc_url( get_the_post_thumbnail_url() ). '" class="">'
                        . '</div><!-- .col-12 -->'
                        . '';
            }

            $out .= '</div><!-- .row -->';
            $out .= '</div><!-- .child-element-wrapper -->';
            $out .= '</div><!-- .col-md-6  child-element-->';
        endwhile;
        wp_reset_postdata();

        return $out;
    }

}
