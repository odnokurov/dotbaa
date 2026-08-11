<?php
return [
    //Класс аутентификации
    'auth' => \Src\Auth\Auth::class,
    //Клас пользователя
    'identity' => \Model\User::class,
    //Классы для middleware
    'routeAppMiddleware' => [
        'auth' => \Middlewares\AuthMiddleware::class,
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