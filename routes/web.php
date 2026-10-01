<?php

use Src\Route;

// Авторизация и главная страница
Route::add(['GET', 'POST'], '/', [Controller\Site::class, 'login']);
Route::add(['GET', 'POST'], '/hello', [Controller\Site::class, 'hello'])->middleware('auth');
Route::add(['GET', 'POST'], '/login', [Controller\Site::class, 'login']);
Route::add(['GET', 'POST'], '/signup', [Controller\Site::class, 'signup']);
Route::add('GET', '/logout', [Controller\Site::class, 'logout']);

// Панель сотрудника деканата
Route::add('GET', '/dashboard', [Controller\DeaneryController::class, 'index'])->middleware('auth');

// Профиль пользователя
Route::add('GET', '/profile/user', [Controller\ProfileController::class, 'profile'])->middleware('auth');
Route::add('GET', '/profile/edit', [Controller\ProfileController::class, 'profile_edit'])->middleware('auth');
Route::add('POST', '/profile/update', [Controller\ProfileController::class, 'profile_update'])->middleware('auth');

// Поиск пользователей
Route::add('GET', '/profile/search', [Controller\ProfileController::class, 'search'])->middleware('auth');

// Администратор (добавление сотрудника)
Route::add(['GET', 'POST'], '/admin/signup', [Controller\AdminController::class, 'signup'])
    ->middleware('auth');

// Управление группами
Route::add('GET', '/groups', [Controller\DeaneryController::class, 'groups'])->middleware('auth');
Route::add(['GET', 'POST'], '/groups/add', [Controller\DeaneryController::class, 'addGroup'])->middleware('auth');
Route::add(['GET', 'POST'], '/groups/add-discipline', [Controller\DeaneryController::class, 'addDisciplineToGroup'])->middleware('auth');

// Управление дисциплинами
Route::add(['GET', 'POST'], '/subjects/add', [Controller\DeaneryController::class, 'addSubject'])->middleware('auth');

// Управление студентами
Route::add('GET', '/students', [Controller\DeaneryController::class, 'students'])->middleware('auth');
Route::add(['GET', 'POST'], '/students/add', [Controller\DeaneryController::class, 'addStudent'])->middleware('auth');
Route::add(['GET', 'POST'], '/students/attach', [Controller\DeaneryController::class, 'attachStudent'])->middleware('auth');

// Успеваемость
Route::add('GET', '/grades', [Controller\GradeController::class, 'index'])->middleware('auth');
Route::add('GET', '/grades/student', [Controller\GradeController::class, 'gradeStudent'])->middleware('auth');
Route::add(['GET', 'POST'], '/grades/group', [Controller\GradeController::class, 'gradeGroup'])->middleware('auth');
Route::add(['GET', 'POST'], '/grades/set-control', [Controller\GradeController::class, 'setControl'])->middleware('auth');;

// Дисциплины: указание курса/семестра
Route::add('GET', '/disciplines/semestr', [Controller\GradeController::class, 'disciplinesBySemestr'])->middleware('auth');
// Виды контроля
Route::add('GET', '/controls', [Controller\DeaneryController::class, 'controls'])->middleware('auth');
Route::add(['GET', 'POST'], '/controls/add', [Controller\DeaneryController::class, 'addControl'])->middleware('auth');