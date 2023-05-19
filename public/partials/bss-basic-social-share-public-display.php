<ul class="basic-share-buttons">
<?php
    $post_title = get_the_title();
    $url = get_permalink();
    $id =  get_the_ID();

    $options = ['post_id'=>$id];

    foreach ($this->get_allowed_share_options() as $allowed_share_option) {
        $share_data = $this->{"share_".$allowed_share_option}($post_title,$url,$options);
        ?>
        <li>
            <a 
            data-site="<?=esc_attr($allowed_share_option) ?>" 
            class="<?=esc_attr($share_data['class']) ?>"
            href="<?=$share_data['url']?>" 
            target="_blank" 
            rel="nofollow"
            >
                <img 
                src="<?=esc_attr($share_data['icon']) ?>" 
                style="width: 32px;" 
                title="<?=esc_attr($share_data['title']) ?>" 
                class="ssbb ssbb-img" 
                alt="<?=esc_attr($share_data['alt']) ?>" />
            </a>
        </li>
    <?php

    }//endfore
?>

</ul>


