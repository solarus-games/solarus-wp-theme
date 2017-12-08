<?php get_header();?>
<div id="games" class="game container">
    <div class="row">
        <div class="col-lg-9">
            <?php while ( have_posts() ) : the_post();?>
                <article>
                    <div class="game-header">
                        <div class="game-title">
                            <h1><i class="fa fa-gamepad"></i> <a title="<?php echo Core::get_title($post);?>" href="<?php the_permalink();?>"><?php echo Core::get_title($post);?></a></h1>
                        </div>
                        <div class="game-metas">
                            <div class="developer"><?php echo Core::get_terms('developer');?></div>
                        </div>
                    </div>
                    <div class="game-body">
                        <div class="game-content">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="preview">
                                        <?php the_post_thumbnail();?>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="details">
                                        <div class="row">
                                            <div class="col-lg-3"><strong><?php echo __("Release date", "solarus");?></strong></div>
                                            <div class="col-lg-9"><?php echo Core::get_post_meta('_release_date');?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3"><strong><?php echo __("Languages", "solarus");?></strong></div>
                                            <div class="col-lg-9"><?php echo Core::get_terms('language');?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3"><strong><?php echo __("Players", "solarus");?></strong></div>
                                            <div class="col-lg-9"><?php echo Core::get_terms('group_player');?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3"><strong><?php echo __("Type", "solarus");?></strong></div>
                                            <div class="col-lg-9"><?php echo Core::get_terms('genre');?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3"><strong><?php echo __("Age", "solarus");?></strong></div>
                                            <div class="col-lg-9"><?php echo Core::get_terms('classification');?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3"><strong><?php echo __("License", "solarus");?></strong></div>
                                            <div class="col-lg-9"><?php echo Core::get_terms('license');?></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-3"><strong><?php echo __("Controls", "solarus");?></strong></div>
                                            <div class="col-lg-9"><?php echo Core::get_terms('controler');?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="description">
                                <h2><?php echo __("Overview", "solarus");?></h2>
                                <?php echo Core::get_content($post);?>
                            </div>
                            <div class="pictures">
                                <h2><?php echo __("Screenshots", "solarus");?></h2>

                            </div>
                            <div class="downloads">
                                <h2><?php echo __("Download", "solarus");?></h2>

                            </div>
                        </div>
                    </div>
                </article>
            <?php endwhile;?>
        </div>
        <div class="col-lg-3">
            <div id="sidebar">
                <ul>
                    <?php dynamic_sidebar('sidebar-games');?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php get_footer();?>

