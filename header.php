<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
    <!--[if lt IE 9]>
    <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
    <![endif]-->
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header id="header">
        <div class="container">
            <a href="/" class="navbar-brand"><?php echo get_bloginfo("name");?></a>
            <?php wp_nav_menu( array('theme_location' => 'header-menu-left', 'menu_class' => 'nav navbar-nav')); ?>
            <?php wp_nav_menu( array('theme_location' => 'header-menu-right', 'menu_class' => 'nav navbar-nav navbar-right')); ?>
        </div>
    </header>
    <div id="breadcrumb">
        <div class="container">
            <?php if (is_home()):?>
                <div class="item">
                    <?php echo __("Home", "solarus");?>
                </div>
            <?php else:?>
                <div class="item">
                    <a href="/" title="<?php echo __("Home", "solarus");?>"><?php echo __("Home", "solarus");?></a>
                </div>
            <?php endif;?>
            <?php if (is_page()):?>
                <?php if ($post->post_parent > 0):?>
                    <div class="item">
                        <a href="<?php echo get_the_permalink($post->post_parent);?>" title="<?php echo get_the_title($post->post_parent);?>"><?php echo get_the_title($post->post_parent);?></a>
                    </div>
                <?php endif;?>
                <div class="item">
                   <?php the_title();?>
                </div>
            <?php endif;?>
            <?php if (is_archive()):?>
                <div class="item">
                    <?php echo Core::get_archive_name($post->post_type);?>
                </div>
            <?php endif;?>
            <?php if (is_single()):?>
                <div class="item">
                    <a href="<?php echo get_post_type_archive_link($post->post_type);?>" title="<?php echo Core::get_archive_name($post->post_type);?>"><?php echo Core::get_archive_name($post->post_type);?></a>
                </div>
                <div class="item">
                    <?php the_title();?>
                </div>
            <?php endif;?>
        </div>
    </div>
    <main id="main">