<div class="container">
    <?php if (is_front_page()):?>
        <div class="item">
            <?php echo __("Home", "solarus");?>
        </div>
    <?php else:?>
        <div class="item">
            <a href="/" title="<?php echo __("Home", "solarus");?>"><?php echo __("Home", "solarus");?></a>
        </div>
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
    <?php endif;?>
</div>