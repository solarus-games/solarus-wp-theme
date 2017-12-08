<div class="shortcode shortcode-jumbotron">
    <div class="background"></div>
    <div class="grid"></div>
    <div class="curves" data-parallax="scroll" data-image-src="<?php echo get_template_directory_uri();?>/assets/img/jumbotron_curves.svg"></div>
    <div class="jumbotron">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="picture"></div>
                </div>
                <div class="col-lg-6">
                    <div class="logo"></div>
                    <div class="content">
                        <?php echo $content;?>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <a href="#" class="btn btn-default btn-lg">
                                <?php echo __("Overview", "solarus");?>
                            </a>
                            <a href="#" class="btn btn-primary btn-lg">
                                <i class="fa fa-download"></i>
                                <div class="text">
                                    <?php echo __("Download", "solarus");?>
                                    <div class="small"><?php echo __("Version 1.6.0", "solarus");?></div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>