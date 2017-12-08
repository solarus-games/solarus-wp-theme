<div
    class="shortcode shortcode-highlight<?php if ($atts["width"]): ?> col-lg-<?php echo $atts["width"]; ?><?php else: ?> col-lg-12<?php endif; ?>">
    <div class="block">
        <div class="row">
            <?php if ($atts['icon']): ?>
                <div class="col-lg-2">
                    <i class="fa fa-<?php echo $atts['icon']; ?>"></i>
                </div>
            <?php endif; ?>
            <div class="<?php if ($atts['icon']): ?>col-lg-10<?php else: ?> col-lg-12<?php endif; ?>">
                <h2><?php echo $atts["title"]; ?></h2>
                <div class="content"><?php echo $content; ?></div>
            </div>
        </div>
    </div>
</div>