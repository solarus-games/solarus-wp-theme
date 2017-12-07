<div class="shortcode shortcode-games-thumbnail">
    <div class="container">
        <div class="row">
            <?php foreach($posts as $p):?>
                <div class="col-lg-4">
                    <div class="thumbnail">
                        <a href="<?php echo get_the_permalink($p);?>" title="<?php echo Core::get_title($p);?>">
                            <?php echo get_the_post_thumbnail($p->ID);?>
                        </a>
                    </div>
                </div>
            <?php endforeach;?>
        </div>
    </div>
</div>