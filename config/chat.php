<?php

return [
    'qiscus' => [
        'auth_endpoint' => env('QISCUS_API_URL') . '/login_or_register',
        'create_room_endpoint' => env('QISCUS_API_URL') . '/create_room',
        'add_participant_endpoint' => env('QISCUS_API_URL') . '/add_room_participants',
        'load_comments_endpoint' => env('QISCUS_API_URL').'/load_comments',
        'load_comments_limit' => 50,
        'success_code'  => [200]
    ]
];
