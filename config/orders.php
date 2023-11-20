<?php

return [
    'service' => [
        'pending' => [
            'pending',
            'reschedule',
            'reschedule-cust',
        ],
        'confirm' => [
            'reschedule-confirmed',
            'confirmed',
        ],
        'ongoing' => [
            'arrived',
            'service-done',
            'payment-pending'
        ],
        'done' => [
            'payment-done'
        ],
        'cancel' => [
            'cancelled'
        ]
    ],

    'dealer' => [
        'ongoing' => [
            "new-order",
            "P4",
            "bookingfee-vareq",
            "bookingfee-paid",
            "dp-vareq",
            "dp-paid",
            "RD OP",
            "DP OP",
            "AV OP"
        ],
        'done' => [
            'GL OP', 
            'DB OP',
            'bookingfee-expired',
            'dp-expired',
            'cancel-by-customer',
            'AP RF', 
            'RD CA'
        ],
    ]
];