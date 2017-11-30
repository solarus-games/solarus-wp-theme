<?php

class Core
{

    public function __construct()
    {

        $this->register_hooks();

    } //EOCo

    public static function factory()
    {

        return new Core();

    } //EOM

    public function register_hooks()
    {

        add_theme_support('post-thumbnails');
        add_action('init', array($this, 'register_post_types'));
        add_action('init', array($this, 'register_taxonomies'));
        add_action('init', array($this, 'register_menus'));
        add_action('init', array($this, 'register_sidebars'));
        add_action('add_meta_boxes', array($this, 'register_metaboxes'));
        add_action('wp_enqueue_scripts', array($this, 'register_scripts'));
        add_action('wp_enqueue_scripts', array($this, 'register_styles'));
        add_action('admin_enqueue_scripts', array($this, 'register_scripts'));
        add_action('admin_enqueue_scripts', array($this, 'register_styles'));
        add_action('admin_init', array($this, 'unregister_fields'));
        add_action('save_post', array($this, 'save_post'));

    } //EOM


    public function unregister_fields()
    {

        remove_post_type_support('game', 'editor');
        remove_post_type_support('page', 'editor');
        remove_post_type_support('post', 'editor');

    }

    public function register_post_types()
    {

        $labels = array(
            'name' => __("Jeux", "solarus"),
            'singular_name' => __('Jeu', 'solarus'),
            'menu_name' => __("Jeux", "solarus"),
            'name_admin_bar' => __('Jeu', 'solarus'),
            'add_new' => __('Ajouter nouveau', 'solarus'),
            'add_new_item' => __('Ajouter nouveau jeu', 'solarus'),
            'new_item' => __('Nouveau jeu', 'solarus'),
            'edit_item' => __('Editer jeu', 'solarus'),
            'view_item' => __('Voir jeu', 'solarus'),
            'all_items' => __('Tous les jeux', 'solarus'),
            'search_items' => __('Rechercher jeux', 'solarus'),
            'parent_item_colon' => __('Jeux parents', 'solarus'),
            'not_found' => __('Aucun jeu trouvé.', 'solarus'),
            'not_found_in_trash' => __('Aucun jeux trouvés dans la corbeille.', 'solarus')
        );

        $args = array(
            'labels' => $labels,
            'description' => __('Jeux Solarus.', 'solarus'),
            'public' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'games'),
            'capability_type' => 'post',
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => null,
            'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments')
        );

        register_post_type('game', $args);

    } //EOM

    public function register_taxonomies()
    {
        $labels = array(
            'name' => __('Genres', 'solarus'),
            'singular_name' => __('Genre', 'solarus'),
            'search_items' => __('Rechercher genres', 'solarus'),
            'all_items' => __('Tous les genres', 'solarus'),
            'parent_item' => __('Genre parent', 'solarus'),
            'parent_item_colon' => __('Genre parent : ', 'solarus'),
            'edit_item' => __('Editer genre', 'solarus'),
            'update_item' => __('Mettre à jour genre', 'solarus'),
            'add_new_item' => __('Ajouter nouveau genre', 'solarus'),
            'new_item_name' => __('Nom du nouveau genre', 'solarus'),
            'menu_name' => __('Genre', 'solarus'),
        );

        $args = array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'genre'),
        );

        register_taxonomy('genre', array('game'), $args);

        $labels = array(
            'name' => __('Plateformes', 'solarus'),
            'singular_name' => __('Plateforme', 'solarus'),
            'search_items' => __('Rechercher plateformes', 'solarus'),
            'all_items' => __('Toutes les plateformes', 'solarus'),
            'parent_item' => __('Plateforme parente', 'solarus'),
            'parent_item_colon' => __('Plateforme parente : ', 'solarus'),
            'edit_item' => __('Editer plateforme', 'solarus'),
            'update_item' => __('Mettre à jour plateforme', 'solarus'),
            'add_new_item' => __('Ajouter nouvelle plateforme', 'solarus'),
            'new_item_name' => __('Nom de la nouvelle plateforme', 'solarus'),
            'menu_name' => __('Plateforme', 'solarus'),
        );

        $args = array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'platform'),
        );

        register_taxonomy('platform', array('game'), $args);

        $labels = array(
            'name' => __('Langues', 'solarus'),
            'singular_name' => __('Langue', 'solarus'),
            'search_items' => __('Rechercher langues', 'solarus'),
            'all_items' => __('Toutes les langues', 'solarus'),
            'parent_item' => __('Langue parente', 'solarus'),
            'parent_item_colon' => __('Langue parente : ', 'solarus'),
            'edit_item' => __('Editer langue', 'solarus'),
            'update_item' => __('Mettre à jour langue', 'solarus'),
            'add_new_item' => __('Ajouter nouvelle langue', 'solarus'),
            'new_item_name' => __('Nom de la nouvelle langue', 'solarus'),
            'menu_name' => __('Langue', 'solarus'),
        );

        $args = array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'language'),
        );

        register_taxonomy('language', array('game'), $args);

        $labels = array(
            'name' => __('Développeurs', 'solarus'),
            'singular_name' => __('Développeur', 'solarus'),
            'search_items' => __('Rechercher développeurs', 'solarus'),
            'all_items' => __('Tous les développeurs', 'solarus'),
            'parent_item' => __('Développeur parent', 'solarus'),
            'parent_item_colon' => __('Développeur parent : ', 'solarus'),
            'edit_item' => __('Editer développeur', 'solarus'),
            'update_item' => __('Mettre à jour développeur', 'solarus'),
            'add_new_item' => __('Ajouter nouveau développeur', 'solarus'),
            'new_item_name' => __('Nom du nouveau développeur', 'solarus'),
            'menu_name' => __('Développeur', 'solarus'),
        );

        $args = array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'developer'),
        );

        register_taxonomy('developer', array('game'), $args);

        $labels = array(
            'name' => __('Classifications', 'solarus'),
            'singular_name' => __('Classification', 'solarus'),
            'search_items' => __('Rechercher classifications', 'solarus'),
            'all_items' => __('Toutes les classifications', 'solarus'),
            'parent_item' => __('Classification parente', 'solarus'),
            'parent_item_colon' => __('Classification parente : ', 'solarus'),
            'edit_item' => __('Editer classification', 'solarus'),
            'update_item' => __('Mettre à jour classification', 'solarus'),
            'add_new_item' => __('Ajouter nouvelle classification', 'solarus'),
            'new_item_name' => __('Nom de la nouvelle classification', 'solarus'),
            'menu_name' => __('Classification', 'solarus'),
        );

        $args = array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'classification'),
        );

        register_taxonomy('classification', array('game'), $args);

        $labels = array(
            'name' => __('Licences', 'solarus'),
            'singular_name' => __('Licence', 'solarus'),
            'search_items' => __('Rechercher licences', 'solarus'),
            'all_items' => __('Toutes les licences', 'solarus'),
            'parent_item' => __('Licence parente', 'solarus'),
            'parent_item_colon' => __('Licence parente : ', 'solarus'),
            'edit_item' => __('Editer licence', 'solarus'),
            'update_item' => __('Mettre à jour licence', 'solarus'),
            'add_new_item' => __('Ajouter nouvelle licence', 'solarus'),
            'new_item_name' => __('Nom de la nouvelle licence', 'solarus'),
            'menu_name' => __('Licence', 'solarus'),
        );

        $args = array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'license'),
        );

        register_taxonomy('license', array('game'), $args);

        $labels = array(
            'name' => __('Contrôleurs', 'solarus'),
            'singular_name' => __('Contrôleur', 'solarus'),
            'search_items' => __('Rechercher contrôleurs', 'solarus'),
            'all_items' => __('Tous les contrôleurs', 'solarus'),
            'parent_item' => __('Contrôleur parent', 'solarus'),
            'parent_item_colon' => __('Contrôleur parent : ', 'solarus'),
            'edit_item' => __('Editer contrôleur', 'solarus'),
            'update_item' => __('Mettre à jour contrôleur', 'solarus'),
            'add_new_item' => __('Ajouter nouveau contrôleur', 'solarus'),
            'new_item_name' => __('Nom du nouveau contrôleur', 'solarus'),
            'menu_name' => __('Contrôleur', 'solarus'),
        );

        $args = array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'controler'),
        );

        register_taxonomy('controler', array('game'), $args);

    } //EOM

    public function register_menus()
    {

        register_nav_menu('header-menu-left', __('Header menu (gauche)', 'solarus'));
        register_nav_menu('header-menu-right', __('Header menu (droite)', 'solarus'));

    } //EOM

    public function register_metaboxes()
    {

        global $post;
        $type_content = get_post_meta($post->ID, '_type_content', true);
        add_meta_box(
            'post-type-content',
            __('Type de contenu', 'solarus'),
            array($this, 'get_metabox_type_content'),
            array('game', 'page', 'post'),
            'normal',
            'high'
        );
        switch($type_content) {
            case 'md':
                add_meta_box(
                    'post-content-default',
                    __('Contenu'),
                    array($this, 'get_metabox_content_md'),
                    array('game', 'page', 'post'),
                    'normal',
                    'high'
                );
                break;
            case 'txt':
                add_meta_box(
                    'post-content-default',
                    __('Contenu'),
                    array($this, 'get_metabox_content_txt'),
                    array('game', 'page', 'post'),
                    'normal',
                    'high'
                );
                break;
            default:
                add_meta_box(
                    'post-content-default',
                    __('Contenu'),
                    array($this, 'get_metabox_content_default'),
                    array('game', 'page', 'post'),
                    'normal',
                    'high'
                );

        }
        add_meta_box(
            'game-informations',
            __('Informations'),
            array($this, 'get_metabox_game_informations'),
            'game',
            'normal',
            'high'
        );
    }

    public function register_sidebars()
    {

        register_sidebar(array(
            'name' => __('Sidebar blog ', 'solarus'),
            'id' => 'sidebar-blog',
            'before_widget' => '<li id="%1$s" class="widget %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        ));
        register_sidebar(array(
            'name' => __('Sidebar games ', 'solarus'),
            'id' => 'sidebar-games',
            'before_widget' => '<li id="%1$s" class="widget %2$s">',
            'after_widget' => '</li>',
            'before_title' => '<h2 class="widget-title">',
            'after_title' => '</h2>',
        ));
        for ($i = 1; $i <= 4; $i++) {
            register_sidebar(array(
                'name' => __('Sidebar footer ' . $i, 'solarus'),
                'id' => 'sidebar-footer-' . $i,
                'before_widget' => '<li id="%1$s" class="widget %2$s">',
                'after_widget' => '</li>',
                'before_title' => '<h2 class="widget-title">',
                'after_title' => '</h2>',
            ));
        }

    }

    public function register_scripts()
    {

        $url = get_template_directory_uri();
        wp_enqueue_script('jquery', $url . '/assets/plugins/jquery/jquery.min.js', false);
        if (is_admin() == false) {
            wp_deregister_script('jquery');
            wp_enqueue_script('bootstrap', $url . '/assets/plugins/bootstrap/js/bootstrap.min.js', false);
        } else {
            wp_enqueue_script('admin', $url . '/assets/js/admin.js', false);
        }

    } //EOM

    public function register_styles()
    {

        $url = get_template_directory_uri();
        if (is_admin() == false) {
            wp_enqueue_style('bootstrap', $url . '/assets/plugins/bootstrap/css/bootstrap.min.css', false);
            wp_enqueue_style('fontawesome', $url . '/assets/plugins/fontawesome/css/font-awesome.min.css', false);
            wp_enqueue_style('style', $url . '/assets/css/style.css', false);
        }

    } //EOM

    public static function load_view($path = false, $vars = array())
    {

        if ($path == false) {
            return false;
        }
        if (is_file(get_template_directory() . '/views/' . $path . '.php')) {
            ob_start();
            extract($vars, EXTR_SKIP | EXTR_REFS);
            include(get_template_directory() . '/views/' . $path . '.php');
            return ob_get_clean();
        }
        return false;

    } //EOM

    public function get_metabox_game_informations()
    {

        $args = array();
        echo Core::load_view('admin/metaboxes/game_informations', $args);

    } //EOM

    public function get_metabox_type_content()
    {

        global $post;
        $args = array(
            'type_content' => get_post_meta($post->ID, '_type_content', true)
        );
        echo Core::load_view('admin/metaboxes/type_content', $args);

    } //EOM

    public function get_metabox_content_default()
    {

        global $post;
        wp_editor($post->post_content, 'content');

    } //EOM

    public function get_metabox_content_md()
    {

        global $post;
        $args = array();
        echo Core::load_view('admin/metaboxes/content_md', $args);


    } //EOM

    public function get_metabox_content_txt()
    {

        global $post;
        $args = array();
        echo Core::load_view('admin/metaboxes/content_txt', $args);


    } //EOM

    public function save_post()
    {
        global $post;
        switch ($post->post_type) {
            case 'game':
                $this->save_post_game();
                break;
        }
        // Update Metadata (type_content)
        if (isset($_POST['type_content']) && !empty($_POST['type_content'])) {
            update_post_meta($post->ID, '_type_content', $_POST['type_content']);
        } else {
            delete_post_meta($post->ID, '_type_content');
        }

    } //EOM

    public function save_post_game()
    {

    } //EOM

    public static function get_archive_name($post_type = false)
    {

        if ($post_type == false) {
            return false;
        }
        switch ($post_type) {
            case 'game':
                $name = __("Games", "solarus");
                break;
            default:
                $name = __("Blog", "solarus");
                break;
        }

        return $name;

    } //EOM

    public static function get_terms($taxonomy = false, $id = false)
    {

        if ($taxonomy == false) {
            return false;
        }
        if ($id == false) {
            global $post;
            $id = $post->ID;
        }
        $terms = wp_get_post_terms($id, $taxonomy);
        $result = "";
        foreach ($terms as $term) {
            $result .= '<a title="' . $term->name . '" href="' . get_term_link($term) . '">' . $term->name . '</a>';
        }
        return $result;

    } //EOM


    public static function get_post_meta($meta = false, $id = false)
    {

        if ($meta == false) {
            return false;
        }
        if ($id == false) {
            global $post;
            $id = $post->ID;
        }

        return get_post_meta($id, $meta, true);

    } //EOM


} //EOC


?>