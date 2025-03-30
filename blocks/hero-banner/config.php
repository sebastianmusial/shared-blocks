<?php

return [
    'title'       => __('Hero Banner', 'custom-blocks'),
    'description' => __('Custom hero banner description', 'custom-blocks'),
    'category'    => 'custom-blocks',
    'icon'        => 'cover-image',
    'keywords'    => ['hero', 'banner'],
    'supports'    => [
        'align'    => ['wide', 'full'],
        'mode'     => true,
        'anchor'   => true,
        'jsx'      => true,
    ],
];