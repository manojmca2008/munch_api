<?php
namespace Search;

use Zend\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'base-search' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/wapi/search',
                    'defaults' => [
                        'controller' => Controller\SearchController::class,
                    ],
                ],
            ],
            'mobile-search' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/api/search',
                    'defaults' => [
                        'controller' => Controller\MobSearchController::class,
                    ],
                ],
            ],
        ],
    ],
];