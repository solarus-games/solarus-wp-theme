<?php get_header();?>
<div id="blog" class="blog-articles container">
    <div class="col-lg-9">
        <?php the_archive_title( '<h1 class="blog-title">' . __("Blog", 'solarus') . ' - ', '</h1>' );?>
        <?php while ( have_posts() ) : the_post();?>
            <article>
                <div class="article-header">
                    <div class="article-title">
                        <h1><a title="<?php echo Core::get_title($post);?>" href="<?php the_permalink();?>"><?php echo Core::get_title($post);?></a></h1>
                    </div>
                    <div class="article-metas">
                        <div class="date"><i class="fa fa-calendar-o"></i>&nbsp;<?php echo get_the_date("m-d-Y H:i:s"); ?></div>
                        <div class="categories"><i class="fa fa-sitemap"></i>&nbsp;<?php the_category();?></div>
                    </div>
                </div>
                <div class="article-body">
                    <div class="article-content">
                        <?php echo Core::get_content($post);?>
                    </div>
                </div>
                <div class="article-footer">
                    <div class="article-comments">
                        <i class="fa fa-comment-o"></i>&nbsp;<a title="<?php echo Core::get_title($post);?>" href="<?php the_permalink();?>">2 comments</a>
                    </div>
                </div>
            </article>
        <?php endwhile;?>
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
                <?php dynamic_sidebar('sidebar-blog');?>
            </ul>
        </div>
    </div>
</div>
<?php get_footer();?>
