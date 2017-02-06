<?php
return [
    'type' => 'cpt',
    'name' => 'book',
    'supports' => [
        'title', 'editor', 'thumbnail',
    ],
    'labels' => [
        'has_one' => 'Book',
        'has_many' => 'Books',
        'text_domain' => 'sage',
    ],
];