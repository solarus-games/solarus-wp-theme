<?php

class Widget
{

    public function __construct()
    {

        add_action('widgets_init', array($this, 'init_widgets'));

    } //EOCo

    public static function factory()
    {

        return new Widget();

    } //EOM

    public function init_widgets()
    {

        register_widget('Summary_widget');
        register_widget('Filter_game_widget');

    } //EOM

} //EOC

class Filter_game_widget extends WP_Widget
{

    function __construct()
    {

        $widget_args = array(
            'classname' => 'widget-filter-game',
            'description' => __('Filtre jeu', 'solarus')
        );

        parent::__construct(
            'widget_filter_game',
            __('Filtre jeu', 'solarus'),
            $widget_args
        );

    } //EOM

    function widget($args, $instance)
    {

        $title = '';
        if (isset($instance['title'])) {
            $title = esc_attr($instance['title']);
        }
        $taxonomy = '';
        if (isset($instance['taxonomy'])) {
            $taxonomy = esc_attr($instance['taxonomy']);
        }
        $terms = array();
        $term = false;
        if ($taxonomy) {
            $terms = get_terms($taxonomy);
            if (isset($_GET[$taxonomy])) {
                $term = $_GET[$taxonomy];
            }
        }
        $vars = array(
            'args' => $args,
            'title' => $title,
            'terms' => $terms,
            'currentTerm' => $term,
            'currentTaxonomy' => $taxonomy,
            'widget' => $this,
        );
        $content =  Core::load_view('front/widgets/filter_game', $vars);

        echo $content;
    }

    function update($new_instance, $old_instance)
    {

        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['taxonomy'] = strip_tags($new_instance['taxonomy']);

        return $instance;

    } //EOM

    function form($instance)
    {

        $title = '';
        if (isset($instance['title'])) {
            $title = esc_attr($instance['title']);
        }
        $taxonomy = '';
        if (isset($instance['taxonomy'])) {
            $taxonomy = esc_attr($instance['taxonomy']);
        }
        $taxonomies = get_object_taxonomies('game', 'objects');
        $vars = array(
            'title' => $title,
            'taxonomies' => $taxonomies,
            'currentTaxonomy' => $taxonomy,
            'widget' => $this
        );
        echo Core::load_view('admin/widgets/filter_game', $vars);

    } //EOM

}

class Summary_widget extends WP_Widget
{

    function __construct()
    {

        $widget_args = array(
            'classname' => 'widget-summary',
            'description' => __('Sommaire', 'solarus')
        );

        parent::__construct(
            'widget_summary',
            __('Sommaire', 'solarus'),
            $widget_args
        );

    } //EOM

    function widget($args, $instance)
    {

        $title = '';
        if (isset($instance['title'])) {
            $title = esc_attr($instance['title']);
        }
        $summary = array();
        global $post;
        if ($post) {
            $type_content = Core::get_post_meta('_type_content', $post->ID);
            switch($type_content) {
                case 'md':
                case 'txt':
                    $file = Core::get_solarus_file($post, $type_content, get_locale());
                    if ($file) {
                        $content = file_get_contents($file);
                        preg_match_all('/## *(.*)\n/', $content, $matches);
                        $summary = $matches[1];
                    }
                    break;
            }
        }
        $vars = array(
            'args' => $args,
            'title' => $title,
            'summary' => $summary,
            'widget' => $this,
        );
        $content =  Core::load_view('front/widgets/summary', $vars);
        echo $content;
    }

    function update($new_instance, $old_instance)
    {

        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        return $instance;

    } //EOM

    function form($instance)
    {

        $title = '';
        if (isset($instance['title'])) {
            $title = esc_attr($instance['title']);
        }
        $vars = array(
            'title' => $title,
            'widget' => $this
        );
        echo Core::load_view('admin/widgets/summary', $vars);

    } //EOM

}