<?php if (count($terms) > 1):?>
    <?php echo $args['before_widget']; ?>
    <?php if ( $title ) {
        echo $args['before_title'] . $title . $args['after_title'];
    } ?>
    <ul>
        <?php $count = 0;?>
        <?php foreach($terms as $term):?>
            <li><a<?php if ($term->term_id == $currentTerm):?> class="selected"<?php endif;?> href="<?php echo Core::get_url_game_filter($currentTaxonomy, $term->term_id);?>" title="<?php echo $term->name;?>"><?php echo $term->name;?></a></li>
            <?php $count++;?>
        <?php endforeach;?>
    </ul>
    <?php echo $args['after_widget']; ?>
<?php endif;?>
