<select data-toggle="type-content" name="type_content">
    <option value="0"<?php if ($type_content == ''):?> selected="selected"<?php endif;?>><?php echo __('Classique', 'zf');?></option>
    <option value="md"<?php if ($type_content == 'md'):?> selected="selected"<?php endif;?>><?php echo __('Format md', 'zf');?></option>
    <option value="txt"<?php if ($type_content == 'txt'):?> selected="selected"<?php endif;?>><?php echo __('Format txt', 'zf');?></option>
</select>