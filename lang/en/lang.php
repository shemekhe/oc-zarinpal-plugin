<?php return [
    'plugin' => [
        'name' => 'ZarinPal',
        'description' => 'Gateway Plugin for ZarinPal payment System.',
    ],
    'setting' => [
        'name' => 'Zarinpal Setting',
        'description' => 'ZarinPal Gateway Setting, merchant ID and CallBack URL',
    ],
    'component' => [
        'payment' => [
            'name' => 'Payment',
            'description' => 'Add in Gateway page for sending request to Zarinpal Website.',
            'properties' => [
                'callback_url' => [
                    'name' => 'CallBack URL',
                    'description' => 'This is a URL that bank call ,after user complete a transaction. By default, this is a URL that you set in ZarinPal setting.',
                    'validation_message' => 'Please Enter CallBack URL',
                ],
            ],
        ],
        'verify_payment' => [
            'name' => 'Verify Payment',
            'description' => 'Add in Verify Page (callback page) for validating user transaction',
        ],
    ],
];