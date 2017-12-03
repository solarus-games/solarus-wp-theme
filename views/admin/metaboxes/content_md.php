<p class="post-attributes-label-wrapper">
    <label for="path_files" class="post-attributes-label"><?php echo __("Chemin vers les fichiers : ", "solarus");?></label>
</p>
<div>
    <input data-toggle="path-files" type="text" name="path_files" id="path_files" class="regular-text" value="<?php echo $path_files;?>"/>
</div>
<p class="post-attributes-label-wrapper">
    <label for="preview" class="post-attributes-label"><?php echo __("Prévisualisation : ", "solarus");?></label>
</p>
<?php if (count($languages) > 0):?>
    <div data-toggle="tabs" class="tabs">
        <ul>
            <?php foreach($languages as $language):?>
                <li><a href="#tab-<?php echo $language->ID;?>"><?php echo $language->post_title;?></a></li>
            <?php endforeach;?>
        </ul>
        <?php foreach($languages as $language):?>
            <div id="tab-<?php echo $language->ID;?>">
                <div class="solarus-preview" data-toggle="preview" data-language="<?php echo Core::get_post_meta('_code', $language->ID);?>" data-id="<?php echo $post->ID;?>" data-type="md"></div>
            </div>
        <?php endforeach;?>
    </div>
<?php endif;?>
<div class="clearfix"></div>
