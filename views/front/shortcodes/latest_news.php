<div class="shortcode shortcode-latest-news<?php if ($atts["width"]): ?> col-lg-<?php echo $atts["width"]; ?><?php else: ?> col-lg-12<?php endif; ?>">
    <ul>
        <?php foreach($posts as $p):?>
            <li>
                <div class="row">
                    <div class="col-lg-4">
                        <div class="thumbnail">
                            <?php echo get_the_post_thumbnail($p->ID);?>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <h2><?php echo Core::get_title($p);?></h2>
                        <div class="metas">
                            <div class="date"><i class="fa fa-calendar-o"></i>&nbsp;<?php echo get_the_date("m-d-Y H:i:s"); ?></div>
                            <div class="comments">
                                <i class="fa fa-comment"></i>&nbsp;
                                <?php if ($p->comment_count > 1):?>
                                    <?php echo $p->comment_count . ' ' . __("comments", "solarus");?>
                                <?php else:?>
                                    <?php echo $p->comment_count . ' ' . __("comment", "solarus");?>
                                <?php endif;?>
                            </div>
                        </div>
                        <div class="excerpt">
                            <?php echo Core::get_excerpt($p);?>
                            <div>
                                <a href="<?php echo get_the_permalink($p->ID);?>" title="<?php echo Core::get_title($p);?>">
                                    <?php echo __("Read more...");?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        <?php endforeach;?>
    </ul>
</div>