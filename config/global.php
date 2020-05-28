<?php
return [
    'pagination_records' => 10,
    'status' => [
        'active' => 1,
        'inactive' => 2,
        'close' => 3,
        'trash' => 4,
        'label' => [
            1 => 'Actice',
            2 => 'InActive',
            3 => 'Close',
            4 => 'Trash'
        ],

    ],
    'menu' => [
        'header' => 1,
        'footer' => 2,
        'body' => 3,
        'category' => 4,
        'label' => [
            1 => 'Header',
            2 => 'Footer',
            3 => 'Category',
            4 => 'Body'
        ],

    ],
    'role' => [
        'member' => 1,
        'admin' => 2,
        'label' => [
            1 => 'Member',
            2 => 'Admin',
        ],

    ],
    'post_type' => [
        'category' => 'category',
        'page' => 'page',
        'article' => 'article',
        'ads' => 'ads'
    ],

    'menu_type' => [
        'category' => 'category',
        'custom_url' => 'custom_url',
        'page' => 'page',
    ],
    'widget_type' => [
        'category' => 'category',
        'html_text' => 'html_text',
        'page' => 'page',
    ],
];
