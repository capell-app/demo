<?php

declare(strict_types=1);

return [

    'resources' => [
        'AutenticationLogResource' => Capell\Admin\Filament\Resources\AuthenticationLogResource::class,
    ],

    'authenticable-resources' => [
        // @phpstan-ignore-next-line
        App\Models\User::class,
    ],

    'navigation' => [
        'authentication-log' => [
            'register' => false, // disabled
            'sort' => 1,
            'icon' => 'heroicon-o-shield-check',
        ],
    ],

    'sort' => [
        'column' => 'login_at',
        'direction' => 'desc',
    ],
];
