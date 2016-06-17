<?php

add_action('widgets_init', function () {
    register_widget('Sidebar_Menu_Widget');
});

class Sidebar_Menu_Widget extends WP_Widget
{
    public function __construct()
    {
        parent::__construct(
            'Sidebar_Menu_Widget', // Base ID
            __('Sidebar Menu', 'text_domain'), // Name
            array('description' => __('List all sub pages in sidebar menu', 'text_domain')) // Args
        );
    }

    /**
     * Front-end display of widget.
     */
    public function widget($args, $instance)
    {
        global $post; 
        $parents = get_post_ancestors($post->ID);
        $id = ($parents) ? $parents[count($parents)-1] : $post->ID;
        $childpages = wp_list_pages( 'sort_column=menu_order&title_li=&child_of=' . $id . '&echo=0' );
        if ($childpages) {
            $string = '<ul>' . $childpages . '</ul>';
            echo $string;
        }
    }
}
