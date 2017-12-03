<?php if (count($languages) > 0):?>
    <div data-toggle="tabs" class="tabs">
        <ul>
            <?php foreach($languages as $language):?>
                <li><a href="#tab-<?php echo $language->ID;?>"><?php echo $language->post_title;?></a></li>
            <?php endforeach;?>
        </ul>
        <?php foreach($languages as $language):?>
            <div id="tab-<?php echo $language->ID;?>">
                <?php if (Core::get_post_meta('_code', $language->ID) == get_locale()):?>
                    <p class="post-attributes-label-wrapper">
                        <label for="post_title" class="post-attributes-label"><?php echo __("Titre : ", "solarus");?></label>
                    </p>
                    <div>
                        <input type="text" name="post_title" id="post_title" class="regular-text" value="<?php echo $post->post_title;?>"/>
                    </div>
                    <?php wp_editor($post->post_content, 'content');?>
                <?php else :?>
                    <p class="post-attributes-label-wrapper">
                        <label for="title_<?php echo Core::get_post_meta('_code', $language->ID);?>" class="post-attributes-label"><?php echo __("Titre : ", "solarus");?></label>
                    </p>
                    <div>
                        <input type="text" name="title_<?php echo Core::get_post_meta('_code', $language->ID);?>" id="title_<?php echo Core::get_post_meta('_code', $language->ID);?>" class="regular-text" value="<?php echo Core::get_post_meta('_title_' . Core::get_post_meta('_code', $language->ID), $post->ID);?>"/>
                    </div>
                    <?php wp_editor(Core::get_post_meta('_content_' . Core::get_post_meta('_code', $language->ID), $post->ID), 'content_' . Core::get_post_meta('_code', $language->ID));?>
                <?php endif;?>
             </div>
        <?php endforeach;?>
    </div>
<?php endif;?>
<div class="clearfix"></div>