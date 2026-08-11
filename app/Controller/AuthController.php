<?php

namespace Controller;
use Src\View;
use Src\Request;
use Src\Auth\Auth;
use Src\Validator\Validator;
class AuthController
{
    public function login(Request $request): string
    {
        //Если просто обращение к странице, то отобразить форму
        if ($request->method === 'GET') {
            return new View('site.login');
        }

        $validator = new Validator($request->all(), [
            'login' => ['required', 'min_length:3', 'max_length:50'],
            'password' => ['required', 'min_length:4'],
        ], [
            'required' => 'Поле :field обязательно',
            'min_length' => 'Поле :field должно содержать минимум :min символов',
            'max_length' => 'Поле :field не должно превышать :max символов'
        ]);

        if ($validator->fails()) {
            return new View('site.login', [
                'message' => implode('; ', array_map(function ($errors) {
                    return implode(', ', $errors);
                }, $validator->errors()))
            ]);
        }

        //Если удалось аутентифицировать пользователя, то редирект
        if (Auth::attempt($request->all())) {
            app()->route->redirect('/dashboard');
        }
        //Если аутентификация не удалась, то сообщение об ошибке
        return new View('site.login', ['message' => 'Неправильные логин или пароль']);
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/hello');
    }

}