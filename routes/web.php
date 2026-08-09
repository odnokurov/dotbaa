<?php

use Src\Route;
// Авторизация и главная страница
Route::add('GET', '/', [Controller\Site::class, 'index'])
    ->middleware('auth');
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);

// Администратор (добавление сотрудника)
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup']);

// Сотрудник деканата
Route::add('GET', '/grades', [Controller\Site::class, 'grades'])->middleware('auth');

// Выбор успеваемости студента (с указанием часов и контроля)
Route::add('GET', '/grades/student', [Controller\Site::class, 'gradeStudent'])->middleware('auth');

// Выбор успеваемости группы (по группам и дисциплинам)
Route::add('GET', '/grades/group', [Controller\Site::class, 'gradeGroup'])->middleware('auth');

// Выбор вида контроля
Route::add('GET', '/grades/control', [Controller\Site::class, 'setControl'])->middleware('auth');

// Просмотр дисциплины + Указание курса/семестра
Route::add('GET', '/disciplines/semestr', [Controller\Site::class, 'disciplinesBySemestr'])->middleware('auth');