<?php

namespace Controller;

use Model\User;
use Src\View;
use Src\Request;
use Src\Validator\Validator;

class AdminController
{
    // Добавление сотрудника (Регистрация сотрудника деканата)
    public function signup(Request $request): string
    {
        if ($request->method === 'POST') {

            $data = $request->all();
            $data['role'] = $data['role'] ?? 'dean';

            // Валидация входящих полей
            $validator = new Validator($request->all(), [
                'surname' => ['required'],
                'name' => ['required'],
                'login' => ['required', 'unique:users,login'],
                'password' => ['required']
            ], [
                'required' => 'Поле :field пусто',
                'unique' => 'Поле :field должно быть уникально'
            ]);

            // Если валидация не прошла, возвращаем ошибки на страницу регистрации
            if ($validator->fails()) {
                return new View('site.signup', [
                    'message' => implode('; ', array_map(function ($errors) {
                        return implode(', ', $errors);
                    }, $validator->errors()))
                ]);
            }

            // Передаем измененный массив $data (с ролью)
            if (User::create($data)) {
                app()->route->redirect('/dashboard');
            }
        }
        return new View('site.signup');
    }
}
