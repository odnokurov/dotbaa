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
                'group_name' => ['required']
            ], [
                'required' => 'Поле :field пусто'
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

    // Добавление дисциплин
    public function addSubject(Request $request): string
    {
        if ($request->method === 'POST') {
            $validator = new \Src\Validator\Validator($request->all(), [
                'subject_name' => ['required']
            ], [
                'required' => 'Поле :field пусто'
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
                'group_id' => ['required'],
                'subject_id' => ['required'],
                'course' => ['required'],
                'semestr' => ['required'],
                'number_of_hours' => ['required'],
                'controll_id' => ['required']
            ], [
                'required' => 'Поле :field пусто'
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
                'surname' => ['required'],
                'name' => ['required'],
                'gender' => ['required'],
                'birthday' => ['required'],
                'group_id' => ['required']
            ], [
                'required' => 'Поле :field пусто'
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
                'student_id' => ['required'],
                'group_id' => ['required']
            ], [
                'required' => 'Поле :field пусто'
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
