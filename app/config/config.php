<?php
/**
 * Application Configuration
 */

return [
    'app_name' => 'Sistem Front Office',
    'app_version' => '1.0',
    'app_url' => 'http://localhost/front-office-app',
    'timezone' => 'Asia/Jakarta',
    'locale' => 'id',
    'debug' => true,
    
    // Features configuration
    'features' => [
        'visitor_registration' => true,
        'visitor_records' => true,
        'employee_management' => true,
        'item_tracking' => false, // Coming soon
        'guest_book' => false,    // Coming soon
    ]
];