<?php

declare(strict_types=1);

return [
    \Zend\ConfigAggregator\ConfigAggregator::ENABLE_CACHE => true,
    'debug'                                               => false,

    'zend-expressive' => [
        'error_handler' => [
            'template_404'   => 'error::404',
            'template_error' => 'error::error',
        ],
    ],
];
