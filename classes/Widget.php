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
    } //EOM

} //EOC

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
                    $content = file_get_contents($file);
                    $items = preg_match_all('/## *(.*)\n/', $content, $matches);
                    $summary = $matches[1];
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