<?php
    $text_content = get_field('text_content');
    $image = get_field('image');
?>

<div class="simple-banner">
    <?php if ($image): ?>
        <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($text_content); ?>" />
    <?php endif; ?>

    <?php if ($text_content): ?>
        <h2><?php echo esc_html($text_content); ?></h2>
    <?php endif; ?>
</div>