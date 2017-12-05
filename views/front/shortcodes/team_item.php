<div class="shortcode shortcode-team-item row">
    <div class="col-lg-2">
        <?php if ($atts['avatar']):?>
            <div class="avatar">
                <img src="<?php echo $atts['avatar'];?>" alt="<?php echo $atts['name'];?>"/>
            </div>
        <?php else:d?>
            <div class="avatar">
               <i class="fa fa-user fa-4x"></i>
            </div>
        <?php endif;?>
    </div>
    <div class="col-lg-10">
        <h3><?php echo $atts['name'];?></h3>
        <p>
            <?php echo $content;?>
        </p>
        <?php if ($atts['twitter-account']):?>
            <div class="link">
                <a title="<?php echo $atts['twitter-account'];?>" href="https://twitter.com/<?php echo $atts['twitter-account'];?>"><?php echo $atts['twitter-account'];?></a>
            </div>
        <?php endif;?>
    </div>
</div>