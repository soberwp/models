<?php
return [
    [
        'type' => 'cpt',
        'name' => 'book',
        'supports' => [
            'title', 'editor', 'thumbnail',
        ],
    ],
    [
        'type' => 'cpt',
        'name' => 'album',
        'supports' => [
          'title', 'editor', 'comments',
        ]
    ],
];