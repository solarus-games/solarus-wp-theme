<p>
    <label for="<?php echo $widget->get_field_id('title'); ?>">
        <?php _e('Titre : '); ?>
        <input class="widefat" id="<?php echo $widget->get_field_id('title'); ?>" name="<?php echo $widget->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
    </label>
</p>
<p>
    <label for="<?php echo $widget->get_field_id('taxonomy'); ?>">
        <?php _e('Taxonomie : '); ?>
        <select id="<?php echo $widget->get_field_id('taxonomy'); ?>" name="<?php echo $widget->get_field_name('taxonomy'); ?>" class="widefat">
            <option value="0"><?php echo __('Aucun', 'zf');?></option>
            <?php foreach ($taxonomies as $taxonomy):?>
                <option value="<?php echo $taxonomy->name;?>"<?php if ($currentTaxonomy == $taxonomy->name):?> selected="selected"<?php endif;?>"><?php echo $taxonomy->label;?></option>
            <?php endforeach;?>
        </select>
    </label>
</p>