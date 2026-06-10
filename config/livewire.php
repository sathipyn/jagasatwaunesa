<?php

return [
    'temporary_file_upload' => [
        'disk' => env('LIVEWIRE_UPLOAD_DISK', 'local'),
        'directory' => env('LIVEWIRE_UPLOAD_DIRECTORY', 'livewire-tmp'),
        'rules' => null,
        'middleware' => null,
        'preview_mimes' => [
            'png', 'gif', 'bmp', 'svg', 'wav', 'mp4',
            'mov', 'avi', 'wmv', 'mp3', 'm4a',
            'jpg', 'jpeg', 'mpga', 'webp', 'wma',
        ],
        'max_upload_time' => 5,
        'cleanup' => true,
    ],
];
