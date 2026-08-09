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
        return new View('site.dashboard');
    }

    // Добавление групп
    public function addGroup(Request $request): string
    {
        if ($request->method === 'POST') {
            Group::create($request->all());
        }
        return new View('site.groups.add');
    }

    // Прикрепить дисциплину к группе (Запись в учебный план)
    public function addDisciplineToGroup(Request $request): string
    {
        if ($request->method === 'POST') {
            Syllabus::create($request->all());
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
            Student::create($request->all());
        }
        return new View('site.students.add', [
            'groups' => Group::all()
        ]);
    }

    // Прикрепить студента к группе
    public function attachStudent(Request $request): string
    {
        if ($request->method === 'POST') {
            $student = Student::find($request->get('student_id'));
            if ($student) {
                $student->group_id = $request->get('group_id');
                $student->save();
            }
        }
        return new View('site.students.attach', [
            'students' => Student::all(),
            'groups' => Group::all()
        ]);
    }
}
