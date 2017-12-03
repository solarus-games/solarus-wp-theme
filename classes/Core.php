<?php
add_filter('query_vars', 'add_state_var', 0, 1);
function add_state_var($vars)
{
    $vars[] = 'state';
    return $vars;
}

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

    public function init()
    {

        $this->register_post_types();
        $this->register_taxonomies();
        $this->register_menus();
        $this->register_sidebars();
        load_default_textdomain();
        //show_admin_bar(false);

    } //EOM

    public function check_if_article_is_translate() {

        //TODO

    } //EOM

    public function get_ajax_preview()
    {
        if (isset($_POST['id']) == false) {
            return false;
        }
        if (isset($_POST['type']) == false) {
            return false;
        }
        if (isset($_POST['language']) == false) {
            return false;
        }
        $p = get_post($_POST['id']);
        $file = Core::get_solarus_file($p, $_POST['type'], $_POST['language']);
        $args = array(
            'file' => $file,
            'title' => Core::get_title($p, $_POST['language']),
            'content' => Core::get_content($p, $_POST['language'])
        );
        echo Core::load_view('admin/ajax/preview', $args);
        exit();

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

    public static function get_content($p = false, $language = false)
    {
        if ($p == false) {
            global $post;
            $p = $post;
        }
        if ($language == false) {
            $language =  get_locale();
        }
        $type_content = Core::get_post_meta('_type_content', $p->ID);
        switch ($type_content) {
            case 'md':
                $file = Core::get_solarus_file($p, 'md', $language);
                $content = '';
                if ($file) {
                    $content = file_get_contents($file);
                }
                $content = Core::get_content_from_content_file($content);
                $parsedown = new Parsedown();
                $content = $parsedown->text($content);
                break;
            case 'txt':
                $file = Core::get_solarus_file($p, 'txt', $language);
                $content = '';
                if ($file) {
                    $content = file_get_contents($file);
                }
                $content = apply_filters('the_content', $content);
                $content = Core::get_content_from_content_file($content);
                break;
            default:
                $content = Core::get_post_meta('_content_' . get_locale(), $p->ID);
                $content = apply_filters('the_content', $content);
        }

        return $content;

    } //EOM

    public static function get_content_from_content_file($content = false)
    {

        if ($content == false) {
            return false;
        }
        preg_match('/^# *(.*)\n/', $content, $matches);
        if (isset($matches[0])) {
            $content = substr($content, strlen($matches[0]));
        }
        return $content;

    } //EOM

    public static function get_current_url()
    {
        $pageURL = 'http';
        if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
            $pageURL .= "s";
        }
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        }
        return $pageURL;

    } //EOM

    public function get_languages()
    {
        $args = array(
            'posts_per_page' => -1,
            'post_type' => 'language'
        );
        $languages = get_posts($args);

        return $languages;

    } //EOM


    public function get_locale($locale)
    {

        $uri = $_SERVER['REQUEST_URI'];
        $uri = explode('/', $uri);
        if (isset($uri[1]) == false) {
            return $locale;
        }
        $languages = $this->get_languages();
        if (count($languages) == 0) {
            return $locale;
        }
        foreach($languages as $language) {
            if ($language->post_name == $uri[1]) {
                return Core::get_post_meta('_code', $language->ID);
            }
        }
        return $locale;

    } //EOM

    public function get_metabox_content_default()
    {

        global $post;
        $languages = $this->get_languages();
        $args = array(
            'post' => $post,
            'languages' => $languages
        );
        echo Core::load_view('admin/metaboxes/content_default', $args);

    } //EOM

    public function get_metabox_content_md()
    {

        global $post;
        $languages = $this->get_languages();
        $args = array(
            'post' => $post,
            'path_files' => Core::get_post_meta('_path_files', $post->ID),
            'languages' => $languages
        );
        echo Core::load_view('admin/metaboxes/content_md', $args);


    } //EOM

    public function get_metabox_content_txt()
    {

        global $post;
        $languages = $this->get_languages();
        $args = array(
            'post' => $post,
            'path_files' => Core::get_post_meta('_path_files', $post->ID),
            'languages' => $languages
        );
        echo Core::load_view('admin/metaboxes/content_txt', $args);


    } //EOM

    public function get_metabox_game_informations()
    {

        global $post;
        $args = array(
            'players' => Core::get_post_meta('_players', $post->ID),
            'video_youtube' => Core::get_post_meta('_video_youtube', $post->ID)
        );
        echo Core::load_view('admin/metaboxes/game_informations', $args);

    } //EOM

    public function get_metabox_game_page_informations()
    {

        global $post;
        $args = array(
            'post_type' => 'game',
            'posts_per_page' => -1,
            'order' => 'ASC',
            'orderby' => 'order'
        );
        $games = get_posts($args);
        $args = array(
            'currentGame' => Core::get_post_meta('_game_id', $post->ID),
            'games' => $games

        );
        echo Core::load_view('admin/metaboxes/game_page_informations', $args);

    } //EOM

    public function get_metabox_language_informations()
    {

        global $post;
        $args = array(
            'code' => Core::get_post_meta('_code', $post->ID)

        );
        echo Core::load_view('admin/metaboxes/language_informations', $args);

    } //EOM

    public function get_metabox_type_content()
    {

        global $post;
        $args = array(
            'type_content' => Core::get_post_meta('_type_content', $post->ID)
        );
        echo Core::load_view('admin/metaboxes/type_content', $args);

    } //EOM

    public function get_option_url($url)
    {

        $uri = $_SERVER['REQUEST_URI'];
        $uri = explode('/', $uri);
        if (isset($uri[1]) == false) {
            return $url;
        }
        $languages = $this->get_languages();
        if (count($languages) == 0) {
            return $url;
        }
        $found = false;
        foreach($languages as $language) {
            if ($uri[1] == $language->post_name) {
                $found = true;
            }
        }
        if ($found == false) {
            return $url . '/en';
        }
        $url = $url . '/' . $uri[1];
        return $url;

    } //EOM

    public function get_page_options_solarus()
    {

        $update = false;
        if (isset($_POST['action']) && $_POST['action'] == 'update') {
            if (isset($_POST['solarus_path_data']) && !empty($_POST['solarus_path_data'])) {
                update_option('solarus_path_data', $_POST['solarus_path_data']);
            }
            $update = true;
        }
        $args = array(
            'solarus_path_data' => get_option('solarus_path_data'),
            'update' => $update
        );
        echo Core::load_view('admin/pages/options_solarus', $args);


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

    public function get_site_url($url, $path)
    {

        $urlParts = explode('/', $url);
        unset($urlParts[3]);
        $url = implode('/', $urlParts);
        return $url . $path;

    } //EOM


    public static function get_solarus_file($p = false, $type = 'md', $language = false)
    {
        if ($p == false) {
            global $post;
            $p = $post;
        }
        if ($language == false) {
            $language =  get_locale();
        }
        $type_content = Core::get_post_meta('_type_content', $p->ID);
        if ($type_content != $type) {
            return false;
        }
        $solarus_path_data = get_option('solarus_path_data');
        $path_files = Core::get_post_meta('_path_files', $p->ID);
        $path = $solarus_path_data . '/' . $p->post_type . '/' . $path_files;
        $path = $path . '.' . $language . '.' . $type;
        if (is_file($path) == false) {
            return false;
        }

        return $path;

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


    public static function get_title($p = false, $language = false)
    {
        if ($p == false) {
            global $post;
            $p = $post;
        }
        if ($language == false) {
            $language =  get_locale();
        }
        $type_content = Core::get_post_meta('_type_content', $p->ID);
        switch ($type_content) {
            case 'md':
                $file = Core::get_solarus_file($p, 'md', $language);
                $content = '';
                if ($file) {
                    $content = file_get_contents($file);
                }
                $title = Core::get_title_from_content_file($content);
                break;
            case 'txt':
                $file = Core::get_solarus_file($p, 'txt', $language);
                $content = '';
                if ($file) {
                    $content = file_get_contents($file);
                }
                $title = Core::get_title_from_content_file($content);
                break;
            default:
                $title = Core::get_post_meta('_title_' . get_locale(), $p->ID);
        }

        return $title;

    } //EOM

    public static function get_title_from_content_file($content = false)
    {

        if ($content == false) {
            return false;
        }
        $title = '';
        preg_match('/^# *(.*)\n/', $content, $matches);
        if (isset($matches[1])) {
            $title = $matches[1];
        }

        return $title;

    }

    public static function get_view_breadcrumb()
    {

        global $post;
        $args = array(
            'post' => $post
        );
        echo Core::load_view('front/breadcrumb', $args);

    } //EOM

    public static function get_view_game()
    {

        global $post;
        $args = array(
            'post' => $post
        );
        echo Core::load_view('front/game', $args);

    } //EOM

    public static function get_view_games()
    {

        $args = array();
        echo Core::load_view('front/games', $args);

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

    function register_admin_pages()
    {

        add_options_page(__('Solarus', 'Solarus'), __('Solarus', 'Solarus'), 'manage_options', 'options_solarus', array($this, 'get_page_options_solarus'));

    } //EOM

    public function register_hooks()
    {

        add_theme_support('post-thumbnails');
        //show_admin_bar(false);

        // Init hook
        add_action('init', array($this, 'init'));

        // Front hooks
        add_action('wp_enqueue_scripts', array($this, 'register_scripts'));
        add_action('wp_enqueue_scripts', array($this, 'register_styles'));
        add_action('wp', array($this, 'check_if_article_is_translate'));

        // Admin hooks
        add_action('add_meta_boxes', array($this, 'register_metaboxes'));
        add_action('admin_enqueue_scripts', array($this, 'register_scripts'));
        add_action('admin_enqueue_scripts', array($this, 'register_styles'));
        add_action('admin_init', array($this, 'unregister_fields'));
        add_action('admin_menu', array($this, 'register_admin_pages'));
        add_action('save_post', array($this, 'save_post'));

        // Ajax hooks
        add_action('wp_ajax_get_preview', array($this, 'get_ajax_preview'));

        // Filters
        if (is_admin() == false) {
            $current_url = $this->get_current_url();
            $urlParts = explode('/', $current_url);
            //var_dump($urlParts);exit();
            if (in_array('wp-login.php', $urlParts) == false && in_array('wp-admin', $urlParts) == false) {
                add_filter('option_siteurl', array($this, 'get_option_url'), 1, 1);
                add_filter('option_home', array($this, 'get_option_url'), 1, 1);
                add_filter('includes_url', array($this, 'get_site_url'), 1, 2);
                add_filter('site_url', array($this, 'get_site_url'), 1, 2);
                add_filter('locale', array($this, 'get_locale'), 1, 2);
            }
        }

    } //EOM

    public function register_menus()
    {

        register_nav_menu('header-menu-left', __('Header menu (gauche)', 'solarus'));
        register_nav_menu('header-menu-right', __('Header menu (droite)', 'solarus'));

    } //EOM

    public function register_metaboxes()
    {

        global $post;
        $type_content = Core::get_post_meta('_type_content', $post->ID);
        add_meta_box(
            'post-type-content',
            __('Type de contenu', 'solarus'),
            array($this, 'get_metabox_type_content'),
            array('game', 'game_page', 'page', 'post'),
            'normal',
            'high'
        );
        switch ($type_content) {
            case 'md':
                add_meta_box(
                    'post-content-default',
                    __('Contenu'),
                    array($this, 'get_metabox_content_md'),
                    array('game', 'game_page', 'page', 'post'),
                    'normal',
                    'high'
                );
                break;
            case 'txt':
                add_meta_box(
                    'post-content-default',
                    __('Détails'),
                    array($this, 'get_metabox_content_txt'),
                    array('game', 'game_page', 'page', 'post'),
                    'normal',
                    'high'
                );
                break;
            default:
                add_meta_box(
                    'post-content-default',
                    __('Détails'),
                    array($this, 'get_metabox_content_default'),
                    array('game', 'game_page', 'page', 'post'),
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
        add_meta_box(
            'game_page-informations',
            __('Informations'),
            array($this, 'get_metabox_game_page_informations'),
            'game_page',
            'side',
            'default'
        );
        add_meta_box(
            'language-informations',
            __('Informations'),
            array($this, 'get_metabox_language_informations'),
            'language',
            'normal',
            'default'
        );
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

        $labels = array(
            'name' => __("Pages de jeu", "solarus"),
            'singular_name' => __('Page de jeu', 'solarus'),
            'menu_name' => __("Pages de jeu", "solarus"),
            'name_admin_bar' => __('Page de jeu"', 'solarus'),
            'add_new' => __('Ajouter nouvelle page de jeu', 'solarus'),
            'add_new_item' => __('Ajouter nouvelle page de jeu', 'solarus'),
            'new_item' => __('Nouvelle page de jeu', 'solarus'),
            'edit_item' => __('Editer page de jeu', 'solarus'),
            'view_item' => __('Voir page de jeu', 'solarus'),
            'all_items' => __('Toutes les pages de jeux', 'solarus'),
            'search_items' => __('Rechercher pages de jeu', 'solarus'),
            'parent_item_colon' => __('Pages de jeu parentes', 'solarus'),
            'not_found' => __('Aucune page de jeu trouvée.', 'solarus'),
            'not_found_in_trash' => __('Aucune page de jeu trouvée dans la corbeille.', 'solarus')
        );

        $args = array(
            'labels' => $labels,
            'description' => __('Pages de jeu.', 'solarus'),
            'public' => false,
            'publicly_queryable' => false,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'game_page'),
            'capability_type' => 'post',
            'has_archive' => false,
            'menu_position' => null,
            'supports' => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'page-attributes')
        );

        register_post_type('game_page', $args);

        $labels = array(
            'name' => __("Langues", "solarus"),
            'singular_name' => __('Langue', 'solarus'),
            'menu_name' => __("Langues", "solarus"),
            'name_admin_bar' => __('Langue', 'solarus'),
            'add_new' => __('Ajouter nouvelle', 'solarus'),
            'add_new_item' => __('Ajouter nouvelle langue', 'solarus'),
            'new_item' => __('Nouvelle langue', 'solarus'),
            'edit_item' => __('Editer langue', 'solarus'),
            'view_item' => __('Voir langue', 'solarus'),
            'all_items' => __('Toutes les langues', 'solarus'),
            'search_items' => __('Rechercher langues', 'solarus'),
            'parent_item_colon' => __('Langues parentes', 'solarus'),
            'not_found' => __('Aucune langue trouvée.', 'solarus'),
            'not_found_in_trash' => __('Aucune langue trouvée dans la corbeille.', 'solarus')
        );

        $args = array(
            'labels' => $labels,
            'description' => __('Langues.', 'solarus'),
            'public' => false,
            'publicly_queryable' => false,
            'show_ui' => true,
            'show_in_menu' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'language'),
            'capability_type' => 'page',
            'has_archive' => false,
            'hierarchical' => false,
            'menu_position' => null,
            'supports' => array('title')
        );

        register_post_type('language', $args);

    } //EOM

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
            wp_enqueue_script('bootstrap', $url . '/assets/plugins/bootstrap/js/bootstrap.min.js', false);
        } else {
            wp_enqueue_script('jquery-ui-tabs');
            wp_enqueue_script('admin', $url . '/assets/js/admin.js', false);
            wp_localize_script('admin', 'ajaxurl', admin_url('admin-ajax.php'));
        }

    } //EOM

    public function register_styles()
    {

        $url = get_template_directory_uri();
        if (is_admin() == false) {
            wp_enqueue_style('bootstrap', $url . '/assets/plugins/bootstrap/css/bootstrap.min.css', false);
            wp_enqueue_style('fontawesome', $url . '/assets/plugins/fontawesome/css/font-awesome.min.css', false);
            wp_enqueue_style('front', $url . '/assets/css/front.css', false);
        } else {
            wp_enqueue_style('admin', $url . '/assets/css/admin.css', false);
        }

    } //EOM

    public function register_taxonomies()
    {

        $labels = array(
            'name' => __('Albums', 'solarus'),
            'singular_name' => __('Album', 'solarus'),
            'search_items' => __('Rechercher albums', 'solarus'),
            'all_items' => __('Tous les albums', 'solarus'),
            'parent_item' => __('Ambum parent', 'solarus'),
            'parent_item_colon' => __('Album parent : ', 'solarus'),
            'edit_item' => __('Editer album', 'solarus'),
            'update_item' => __('Mettre à jour album', 'solarus'),
            'add_new_item' => __('Ajouter nouvel album', 'solarus'),
            'new_item_name' => __('Nom du nouvel album', 'solarus'),
            'menu_name' => __('Albums', 'solarus'),
        );

        $args = array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'album'),
        );

        register_taxonomy('album', array('attachment'), $args);

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
            'menu_name' => __('Genres', 'solarus'),
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
            'menu_name' => __('Plateformes', 'solarus'),
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
            'menu_name' => __('Langues', 'solarus'),
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
            'menu_name' => __('Développeurs', 'solarus'),
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
            'menu_name' => __('Classifications', 'solarus'),
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
            'menu_name' => __('Licences', 'solarus'),
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
            'menu_name' => __('Contrôleurs', 'solarus'),
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

    public function save_post()
    {
        global $post;
        if ($post == false) {
            return false;
        }
        switch ($post->post_type) {
            case 'game':
                $this->save_post_game();
                break;
            case 'game_page':
                $this->save_post_game_page();
                break;
            case 'language':
                $this->save_post_language();
                break;
        }
        // Update Metadata (type_content)
        if (isset($_POST['type_content']) && !empty($_POST['type_content'])) {
            update_post_meta($post->ID, '_type_content', $_POST['type_content']);
        } else {
            delete_post_meta($post->ID, '_type_content');
        }
        if (isset($_POST['path_files']) && !empty($_POST['path_files'])) {
            update_post_meta($post->ID, '_path_files', $_POST['path_files']);
        } else {
            update_post_meta($post->ID, '_path_files', $post->post_name);
        }
        $languages = $this->get_languages();
        foreach($languages as $language) {
            $key = 'content_' . Core::get_post_meta('_code', $language->ID);
            if (isset($_POST[$key]) && !empty($_POST[$key])) {
                update_post_meta($post->ID, '_'.$key, $_POST[$key]);
            } else {
                delete_post_meta($post->ID, '_'.$key);
            }
            $key = 'title_' . Core::get_post_meta('_code', $language->ID);
            if (isset($_POST[$key]) && !empty($_POST[$key])) {
                update_post_meta($post->ID, '_'.$key, $_POST[$key]);
            } else {
                delete_post_meta($post->ID, '_'.$key);
            }
            $key = 'content_' . get_locale();
            if (isset($_POST['content']) && !empty($_POST['content'])) {
                update_post_meta($post->ID, '_'.$key, $_POST['content']);
            } else {
                delete_post_meta($post->ID, '_'.$key);
            }
            $key = 'title_' . get_locale();
            if (isset($_POST['post_title']) && !empty($_POST['post_title'])) {
                update_post_meta($post->ID, '_'.$key, $_POST['post_title']);
            } else {
                delete_post_meta($post->ID, '_'.$key);
            }
        }

    } //EOM

    public function save_post_game()
    {

        global $post;
        if (isset($_POST['players']) && !empty($_POST['players'])) {
            update_post_meta($post->ID, '_players', $_POST['players']);
        } else {
            delete_post_meta($post->ID, '_players');
        }
        if (isset($_POST['video_youtube']) && !empty($_POST['video_youtube'])) {
            update_post_meta($post->ID, '_video_youtube', $_POST['video_youtube']);
        } else {
            delete_post_meta($post->ID, '_video_youtube');
        }

    } //EOM

    public function save_post_game_page()
    {

        global $post;
        if (isset($_POST['game_id']) && !empty($_POST['game_id'])) {
            update_post_meta($post->ID, '_game_id', $_POST['game_id']);
        } else {
            delete_post_meta($post->ID, '_game_id');
        }

    } //EOM

    public function save_post_language()
    {

        global $post;
        if (isset($_POST['code']) && !empty($_POST['code'])) {
            update_post_meta($post->ID, '_code', $_POST['code']);
        } else {
            delete_post_meta($post->ID, '_code');
        }

    } //EOM

    public function unregister_fields()
    {
        
        remove_post_type_support('game', 'editor');
        remove_post_type_support('game_page', 'editor');
        remove_post_type_support('page', 'editor');
        remove_post_type_support('post', 'editor');


    }


} //EOC