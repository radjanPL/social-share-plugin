<?php
$options = get_option('bss_settings');
?>
<p>
    Yes
    <input type="radio"
        <?= ($options['bss_share_stylesheet'] === 'yes') ||
        !isset($options['bss_share_stylesheet']) ||
        empty($options['bss_share_stylesheet']) ? 'checked' : ''; ?>
           name="bss_settings[bss_share_stylesheet]" value="yes">
</p>
<p>
    No
    <input type="radio"
        <?= $options['bss_share_stylesheet'] === 'no' ? 'checked' : ''; ?>
           name="bss_settings[bss_share_stylesheet]" value="no">
</p>