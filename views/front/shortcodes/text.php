<div class="shortcode shortcode-text<?php if ($atts['icon']):?> <?php echo $atts['type'];?><?php endif;?>">
    <div class="row">
        <?php if ($atts['icon']): ?>
            <div class="col-lg-1">
                <div class="icon">
                    <i class="fa fa-<?php echo $atts['icon'];?>"></i>
                </div>
            </div>
        <?php endif; ?>
        <div class="<?php if ($atts['icon']): ?>col-lg-11<?php else :?>col-lg-12<?php endif;?>">
            <h2><?php echo $atts['title'];?></h2>
            <div class="content">
                <?php echo do_shortcode($content);?>
            </div>
        </div>
    </div>
</div>