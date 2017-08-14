<?php

namespace City;

use Zend\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'city' => [
                'type'    => Segment::class,
                'options' => [
                    'route'       => '/city[/:id]',
                    'constraints' => [
                        'id'     => '[0-9]+',
                    ],
                    'defaults'    => [
                        'controller' => Controller\CityController::class
                    ],
                ],
            ],
        ],
    ],
];
