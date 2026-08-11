<?php

namespace Controller;

use Model\Student;
use Model\Group;
use Model\Subject;
use Model\Syllabus;
use Src\View;
use Src\Request;

class DeaneryController
{
    // Главная страница панели управления сотрудника деканата
    public function index(): string
    {
        return new View('site.dashboard', ['user' => app()->auth->user()]);
    }

    // Добавление групп
    public function addGroup(Request $request): string
    {
        if ($request->method === 'POST') {
            $validator = new \Src\Validator\Validator($request->all(), [
                'group_name' => ['required', 'min_length:2', 'max_length:50']
            ], [
                'required' => 'Поле :field пусто',
                'min_length' => 'Поле :field должно содержать минимум :min символов',
                'max_length' => 'Поле :field не должно превышать :max символов'
            ]);

            if ($validator->fails()) {
                return new View('site.groups.add', [
                    'message' => implode('; ', array_map(function ($errors) {
                        return implode(', ', $errors);
                    }, $validator->errors()))
                ]);
            }

            Group::create($request->all());
            app()->route->redirect('/dashboard');
        }
        return new View('site.groups.add');
    }

    // Просмотр всех групп
    public function groups(Request $request): string
    {
        return new View('site.groups.index', [
            'groups' => Group::withCount('students')->get()
        ]);
    }

    // Просмотр всех студентов
    public function students(Request $request): string
    {
        return new View('site.students.index', [
            'students' => Student::with('group')->get()
        ]);
    }

    // Добавление дисциплин
    public function addSubject(Request $request): string
    {
        if ($request->method === 'POST') {
            $validator = new \Src\Validator\Validator($request->all(), [
                'subject_name' => ['required', 'min_length:2', 'max_length:150']
            ], [
                'required' => 'Поле :field пусто',
                'min_length' => 'Поле :field должно содержать минимум :min символов',
                'max_length' => 'Поле :field не должно превышать :max символов'
            ]);

            if ($validator->fails()) {
                return new View('site.subjects.add', [
                    'message' => implode('; ', array_map(function ($errors) {
                        return implode(', ', $errors);
                    }, $validator->errors()))
                ]);
            }

            Subject::create($request->all());
            app()->route->redirect('/dashboard');
        }
        return new View('site.subjects.add');
    }

    // Прикрепить дисциплину к группе (Запись в учебный план)
    public function addDisciplineToGroup(Request $request): string
    {
        if ($request->method === 'POST') {
            $data = $request->all();
            $data['number_of_hours'] = $data['number_of_hours'] ?? $data['hours'] ?? null;
            $data['controll_id'] = $data['controll_id'] ?? $data['control_id'] ?? null;

            $validator = new \Src\Validator\Validator($data, [
                'group_id' => ['required', 'numeric'],
                'subject_id' => ['required', 'numeric'],
                'course' => ['required', 'numeric', 'min:1', 'max:5'],
                'semestr' => ['required', 'numeric', 'min:1', 'max:10'],
                'number_of_hours' => ['required', 'numeric', 'min:1', 'max:1000'],
                'controll_id' => ['required', 'numeric']
            ], [
                'required' => 'Поле :field пусто',
                'numeric' => 'Поле :field должно быть числом',
                'min' => 'Поле :field должно быть не меньше :min',
                'max' => 'Поле :field должно быть не больше :max'
            ]);

            if ($validator->fails()) {
                return new View('site.groups.add_discipline', [
                    'groups' => Group::all(),
                    'subjects' => Subject::all(),
                    'controls' => \Model\TypeOfControll::all(),
                    'message' => implode('; ', array_map(function ($errors) {
                        return implode(', ', $errors);
                    }, $validator->errors()))
                ]);
            }

            Syllabus::create($data);
            app()->route->redirect('/dashboard');
        }
        return new View('site.groups.add_discipline', [
            'groups' => Group::all(),
            'subjects' => Subject::all(),
            'controls' => \Model\TypeOfControll::all()
        ]);
    }

    // Добавление студентов
    public function addStudent(Request $request): string
    {
        if ($request->method === 'POST') {
            $validator = new \Src\Validator\Validator($request->all(), [
                'surname' => ['required', 'alpha', 'min_length:2', 'max_length:100'],
                'name' => ['required', 'alpha', 'min_length:2', 'max_length:100'],
                'patronymic' => ['alpha', 'max_length:100'],
                'gender' => ['required'],
                'birthday' => ['required', 'date'],
                'address' => ['max_length:255'],
                'group_id' => ['required', 'numeric']
            ], [
                'required' => 'Поле :field пусто',
                'alpha' => 'Поле :field должно содержать только буквы',
                'min_length' => 'Поле :field должно содержать минимум :min символов',
                'max_length' => 'Поле :field не должно превышать :max символов',
                'date' => 'Поле :field должно быть корректной датой',
                'numeric' => 'Поле :field должно быть числом'
            ]);

            if ($validator->fails()) {
                return new View('site.students.add', [
                    'groups' => Group::all(),
                    'message' => implode('; ', array_map(function ($errors) {
                        return implode(', ', $errors);
                    }, $validator->errors()))
                ]);
            }

            Student::create($request->all());
            app()->route->redirect('/dashboard');
        }
        return new View('site.students.add', [
            'groups' => Group::all()
        ]);
    }

    // Прикрепить студента к группе
    public function attachStudent(Request $request): string
    {
        if ($request->method === 'POST') {
            $validator = new \Src\Validator\Validator($request->all(), [
                'student_id' => ['required', 'numeric'],
                'group_id' => ['required', 'numeric']
            ], [
                'required' => 'Поле :field пусто',
                'numeric' => 'Поле :field должно быть числом'
            ]);

            if ($validator->fails()) {
                return new View('site.students.attach', [
                    'students' => Student::all(),
                    'groups' => Group::all(),
                    'message' => implode('; ', array_map(function ($errors) {
                        return implode(', ', $errors);
                    }, $validator->errors()))
                ]);
            }

            $student = Student::find($request->get('student_id'));
            if ($student) {
                $student->group_id = $request->get('group_id');
                $student->save();
                app()->route->redirect('/dashboard');
            }
        }
        return new View('site.students.attach', [
            'students' => Student::all(),
            'groups' => Group::all()
        ]);
    }
}
