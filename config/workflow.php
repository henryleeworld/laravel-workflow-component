<?php

return [
    'straight' => [
        'type' => 'workflow',
        'marking_store' => [
            'type'      => 'multiple_state',
            'arguments' => ['currentPlace']
        ],
        'supports' => ['App\Models\Post'],
        'places' => ['draft', 'review', 'rejected', 'published'],
        'transitions' => [
            'to_review' => [
                'from' => 'draft',
                'to' => 'review'
            ],
            'publish' => [
                'from' => 'review',
                'to' => 'published'
            ],
            'reject' => [
                'from' => 'review',
                'to' => 'rejected'
            ]
        ],
    ],
];
