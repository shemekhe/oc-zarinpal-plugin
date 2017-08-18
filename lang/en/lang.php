<?php return [
    'plugin' => [
        'name' => 'ZarinPal',
        'description' => 'Payment Plugin for ZarinPal payment System.',
    ],
    'setting' => [
        'name' => 'Zarinpal Setting',
        'description' => 'Zarinpal Payment Setting, merchant ID and CallBack URL',
    ],
    'component' => [
        'payment' => [
            'name' => 'Payment',
            'description' => 'Add in Paymnet page for sending request to Bank',
            'properties' => [
                'callback_url' => [
                    'name' => 'CallBack URL',
                    'description' => 'This is a URL that bank call after user complete transaction. in defualt, this is a URL that you set in ZarinPal setting.',
                    'validation_message' => 'Please Enter CallBack URL',
                ],
            ],
        ],
        'verify_payment' => [
            'name' => 'Verify Payment',
            'description' => 'Add in Verify Payment Page for Verifying Bank Payment',
        ],
    ],
];