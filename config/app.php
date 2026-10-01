<?php
return [
    //Класс аутентификации
    'auth' => \Src\Auth\Auth::class,

    //Класс пользователя
    'identity' => \Model\User::class,

    // Middleware для отдельных маршрутов
    'routeMiddleware' => [
        'auth' => \Middlewares\AuthMiddleware::class,
    ],

    // Глобальные middleware
    'routeAppMiddleware' => [
        'trim' => \Middlewares\TrimMiddleware::class,
        'specialChars' => \Middlewares\SpecialCharsMiddleware::class,
        'csrf' => \Middlewares\CSRFMiddleware::class,
    ],

    'validators' => [
        'required' => \Validators\RequireValidator::class,
        'unique' => \Validators\UniqueValidator::class,
        'min_length' => \Validators\MinLengthValidator::class,
        'max_length' => \Validators\MaxLengthValidator::class,
        'numeric' => \Validators\NumericValidator::class,
        'min' => \Validators\MinValidator::class,
        'max' => \Validators\MaxValidator::class,
        'date' => \Validators\DateValidator::class,
        'email' => \Validators\EmailValidator::class,
        'alpha' => \Validators\AlphaValidator::class,
    ]
];