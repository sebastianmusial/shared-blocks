<?php

if (!function_exists('acf_add_local_field_group')) {
    return;
}

acf_add_local_field_group([
    'key' => 'cb_group_simple_banner',
    'title' => 'Simple banner fields',
    'fields' => [
        [
            'key' => 'field_text_content',
            'label' => 'Description',
            'name' => 'text_content',
            'type' => 'text',
        ],
        [
            'key' => 'field_image',
            'label' => 'Image',
            'name' => 'image',
            'type' => 'image',
            'return_format' => 'url',
        ],
    ],
    'location' => [
        [
            [
                'param' => 'block',
                'operator' => '==',
                'value' => 'acf/simple-banner',
            ],
        ],
    ],
]);