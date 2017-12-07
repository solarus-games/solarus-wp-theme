<div class="shortcode shortcode-game-sheet">
    <div class="container">
        <div class="row">
            <div class="col-lg-5">
                <div class="thumbnail">
                    <?php echo get_the_post_thumbnail($p->ID);?>
                </div>
            </div>
            <div class="col-lg-7">
                <h2><?php echo Core::get_title($p);?></h2>
                <div class="metas">
                    <ul>
                        <li><strong><?php echo __("Developer", "solarus");?></strong><?php echo Core::get_terms('developer', $p);?></li>
                        <li><strong><?php echo __("Release date", "solarus");?></strong><?php echo Core::get_post_meta('_release_date', $p);?></li>
                        <li><strong><?php echo __("Genre", "solarus");?></strong><?php echo Core::get_terms('genre', $p);?></li>
                    </ul>
                </div>
                <p>
                    <?php echo Core::get_content($p);?>
                </p>
            </div>
        </div>
    </div>
</div>