<?php

if (!function_exists('acf_add_local_field_group')) {
    return;
}

acf_add_local_field_group([
    'key' => 'cb_group_hero_banner',
    'title' => __('Hero Banner settings', 'custom-blocks'),
    'fields' => [
        [
            'key' => 'field_hero_background',
            'label' => __('Background', 'custom-blocks'),
            'name' => 'background',
            'type' => 'image',
            'return_format' => 'array',
            'preview_size' => 'medium',
            'library' => 'all',
            'required' => 0,
        ],
        [
            'key' => 'field_hero_heading',
            'label' => __('Heading', 'custom-blocks'),
            'name' => 'heading',
            'type' => 'text',
            'required' => 0,
        ],
        [
            'key' => 'field_hero_subheading',
            'label' => __('Subheading', 'custom-blocks'),
            'name' => 'subheading',
            'type' => 'textarea',
            'rows' => 3,
        ],
        [
            'key' => 'field_hero_cta',
            'label' => __('CTA button', 'custom-blocks'),
            'name' => 'cta_button',
            'type' => 'link',
            'return_format' => 'array',
        ],
    ],
    'location' => [
        [
            [
                'param' => 'block',
                'operator' => '==',
                'value' => 'acf/hero-banner',
            ],
        ],
    ],
]);