<?php 

namespace ShaneOliver;

class Widgets
{
    protected $widgets_to_unregister = [
        'WP_Widget_Pages',
        'WP_Widget_Calendar',
        'WP_Widget_Links',
        'WP_Widget_Meta',
        'WP_Widget_Search',
        'WP_Widget_Categories',
        'WP_Widget_Recent_Posts',
        'WP_Widget_Recent_Comments',
        'WP_Widget_RSS',
        'WP_Widget_Tag_Cloud',
        'WP_Widget_Media_Audio',
        'WP_Widget_Media_Gallery',
        'WP_Widget_Archives',
        'WP_Widget_Text',
        'WP_Widget_Media_Image',
        'WP_Widget_Media_Video',
        'WP_Widget_Custom_HTML',
        'WP_Nav_Menu_Widget',
    ];

    /**
     * Register sidebars
     */
    public function register()
    {
        $settings = Config::get('settings');

        $defaults = [
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ];

        foreach($settings['sidebars'] as $region) {
            foreach($region as $sidebar) {
                register_sidebar($sidebar + $defaults);
            }
        }
    }

    /**
     * Remove unwanted default widgets
     */
    public function unregister()
    {
        foreach($this->widgets_to_unregister as $widget) {
            unregister_widget($widget);
        };
    }
}
