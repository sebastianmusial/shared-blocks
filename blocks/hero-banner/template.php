<?php
$background = get_field('background');
$heading = get_field('heading');
$subheading = get_field('subheading');
$cta_button = get_field('cta_button');

$classes = 'cb-hero-banner';

if (!empty($block['className'])) {
    $classes .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $classes .= ' align' . $block['align'];
}

$id = isset($block['anchor']) ? $block['anchor'] : 'hero-banner-' . $block['id'];

$style = '';
if ($background && isset($background['url'])) {
    $style = 'background-image: url(' . esc_url($background['url']) . ');';
}

if ($is_preview) {
    $classes .= ' is-preview';

    if (empty($background)) {
        $style = 'background-color: #f5f5f5;';
    }

    if (empty($heading)) {
        $heading = 'Sample Heading';
    }

    if (empty($subheading)) {
        $subheading = 'This is a preview of the hero banner block. Add content to see the final look.';
    }
}
?>

<div id="<?php echo esc_attr($id); ?>" class="<?php echo esc_attr($classes); ?>" style="<?php echo esc_attr($style); ?>">
    <div class="cb-hero-banner__content">
        <?php if ($heading) : ?>
            <h1 class="cb-hero-banner__heading"><?php echo esc_html($heading); ?></h1>
        <?php endif; ?>

        <?php if ($subheading) : ?>
            <div class="cb-hero-banner__subheading"><?php echo wp_kses_post($subheading); ?></div>
        <?php endif; ?>

        <?php if ($cta_button && isset($cta_button['url'])) : ?>
            <a href="<?php echo esc_url($cta_button['url']); ?>"
               class="cb-hero-banner__button"
               <?php echo $cta_button['target'] ? 'target="' . esc_attr($cta_button['target']) . '"' : ''; ?>>
                <?php echo esc_html($cta_button['title']); ?>
            </a>
        <?php endif; ?>
    </div>
</div>