<?php get_header();?>
<div id="games" class="games container">
    <div class="col-lg-9">
        <h1 class="games-title"><?php echo __("Games", 'solarus');?></h1>
        <div class="row">
            <?php while ( have_posts() ) : the_post();?>
                <div class="col-lg-6">
                    <article>
                        <a title="<?php the_title();?>" href="<?php the_permalink();?>">
                            <?php the_post_thumbnail();?>
                        </a>
                        <div class="game-content">
                            <h2><?php the_title();?></h2>
                            <div class="metas">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <strong><?php echo __("Developer:");?></strong>
                                    </div>
                                    <div class="col-lg-8">
                                        <?php echo Core::get_terms('developer', get_the_ID());?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <strong><?php echo __("Release Date:");?></strong>
                                    </div>
                                    <div class="col-lg-8">
                                        <?php echo Core::get_post_meta('_release_date', get_the_ID());?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <strong><?php echo __("Genre:");?></strong>
                                    </div>
                                    <div class="col-lg-8">
                                        <?php echo Core::get_terms('genre', get_the_ID());?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>
            <?php endwhile;?>
        </div>
        <div class="pagination">
            <?php the_posts_pagination( array(
                'screen_reader_text' => ' ',
                'mid_size' => 2,
                'prev_text' => __('Back', 'solarus'),
                'next_text' => __('Onward', 'solarus'),
            ) ); ?>
        </div>
    </div>
    <div class="col-lg-3">
        <div id="sidebar">
            <ul>
                <?php dynamic_sidebar('sidebar-games');?>
            </ul>
        </div>
    </div>
</div>
<?php get_footer();?>
