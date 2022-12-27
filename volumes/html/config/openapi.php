<?php

return [

    'collections' => [
        'default' => [
            'info' => [
                'title' => 'Farm',
                'description' => null,
                'version' => '1.0.0',
                'contact' => [],
            ],

            'servers' => [
                [
                    'url' => env('APP_URL'),
                    'description' => null,
                    'variables' => [],
                ],
            ],

            'tags' => [
                [
                    'name' => 'user',
                    'description' => 'Роуты для работы с пользователем',
                ],
                [
                    'name' => 'auth',
                    'description' => 'Роуты для авторизации и регистрации',
                ],
                [
                    'name' => 'tree',
                    'description' => 'Роуты для работы с деревьями',
                ],
                [
                    'name' => 'plant',
                    'description' => 'Роуты для работы с посадками',
                ],
                [
                    'name' => 'farmLand',
                    'description' => 'Роуты для работы с фермой',
                ],
                [
                    'name' => 'building',
                    'description' => 'Роуты для работы с постройками',
                ],
                [
                    'name' => 'Gems',
                    'description' => 'Роуты для работы с gems',
                ],
            ],

            'security' => [],

            // Route for exposing specification.
            // Leave uri null to disable.
            'route' => [],

            // Register custom middlewares for different objects.
            'middlewares' => ['paths' => [], 'components' => [],],

        ],
    ],

    // Directories to use for locating OpenAPI object definitions.
    'locations' => [
        'callbacks' => [
            app_path('OpenApi/Callbacks'),
        ],

        'request_bodies' => [
            app_path('OpenApi/RequestBodies'),
        ],

        'responses' => [
            app_path('OpenApi/Responses'),
        ],

        'schemas' => [
            app_path('OpenApi/Schemas'),
        ],

        'security_schemes' => [
            app_path('OpenApi/SecuritySchemes'),
        ],
    ],

];
