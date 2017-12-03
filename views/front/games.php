<div id="games" class="games container">
    <div class="col-lg-9">
        <h1 class="games-title"><?php echo __("Games", 'solarus');?></h1>
        <div class="row">
            <?php while ( have_posts() ) : the_post();?>
                <div class="col-lg-6">
                    <?php echo Core::get_view_game();?>
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