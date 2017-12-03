<article>
    <a title="<?php the_title();?>" href="<?php the_permalink();?>">
        <?php the_post_thumbnail();?>
    </a>
    <div class="game-content">
        <h2><?php echo Core::get_title($post);?></h2>
        <div class="metas">
            <div class="row">
                <div class="col-lg-4">
                    <strong><?php echo __("Developer:");?></strong>
                </div>
                <div class="col-lg-8">
                    <?php echo Core::get_terms('developer', get_the_ID());?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <strong><?php echo __("Release Date:");?></strong>
                </div>
                <div class="col-lg-8">
                    <?php echo Core::get_post_meta('_release_date', get_the_ID());?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <strong><?php echo __("Genre:");?></strong>
                </div>
                <div class="col-lg-8">
                    <?php echo Core::get_terms('genre', get_the_ID());?>
                </div>
            </div>
        </div>
    </div>
</article>