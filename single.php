<?php get_header();?>
<div id="blog" class="blog-articles container">
    <div class="col-lg-9">
        <h1 class="blog-title"><?php echo __("Blog", 'solarus');?> - <?php echo __("Article", 'solarus');?></h1>
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
            </article>
            <div class="comments">
                <?php comment_form(); ?>
            </div>
        <?php endwhile;?>
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

