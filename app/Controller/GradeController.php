<?php

namespace Controller;

use Model\Student;
use Model\Group;
use Model\Subject;
use Model\Grade;
use Model\Syllabus;
use Model\Schedule;
use Model\TypeOfControll;
use Src\View;
use Src\Request;

class GradeController
{
    // Просмотр успеваемости / Указание вида контроля (Общая точка входа)
    public function index(Request $request): string
    {
        $groupId = $request->get('group_id');
        $syllabuses = [];

        // Указание вида контроля для дисциплин группы
        if ($request->method === 'POST') {
            foreach ($request->get('controll_id') ?? [] as $syllabusId => $controlId) {
                if (!$controlId) {
                    continue;
                }
                $syllabus = Syllabus::find($syllabusId);
                if ($syllabus) {
                    $syllabus->updateControl($controlId);
                }
            }
        }

        if ($groupId) {
            $syllabuses = Syllabus::where('group_id', $groupId)
                ->with(['subject', 'typeOfControll'])
                ->get();
        }

        return new View('site.grades.set_control', [
            'groups' => Group::all(),
            'controls' => TypeOfControll::all(),
            'syllabuses' => $syllabuses,
            'groupId' => $groupId
        ]);
    }

    // Выбор успеваемости студента (С указанием общего кол-ва часов и вида контроля)
    public function gradeStudent(Request $request): string
    {
        $studentId = $request->get('student_id');
        $grades = [];

        if ($studentId) {
            $grades = Grade::where('student_id', $studentId)
                ->with(['schedule.syllabus.subject', 'schedule.syllabus.typeOfControll'])
                ->get();
        }

        return new View('site.grades.student', [
            'grades' => $grades,
            'students' => Student::all(),
            'studentId' => $studentId
        ]);
    }

    // Указание успеваемости группы (По группам и дисциплинам)
    public function gradeGroup(Request $request): string
    {
        $groupId = $request->get('group_id');
        $subjectId = $request->get('subject_id');
        $grades = [];
        $scheduleId = null;
        $existingGrades = [];
        $students = [];

        // Сохранение выставленных оценок
        if ($request->method === 'POST') {
            $scheduleId = $request->get('schedule_id');
            $savedGrades = $request->get('grades') ?? [];

            foreach ($savedGrades as $studentId => $grade) {
                if ($grade === '') {
                    continue;
                }
                Grade::updateOrCreate(
                    ['student_id' => $studentId, 'schedule_id' => $scheduleId],
                    ['grade' => $grade, 'group_id' => $groupId]
                );
            }
        }

        if ($groupId && $subjectId) {
            $syllabus = Syllabus::where('group_id', $groupId)
                ->where('subject_id', $subjectId)
                ->first();

            if ($syllabus) {
                $scheduleId = $syllabus->schedules()->orderBy('date_of_lesson', 'desc')
                    ->value('schedule_id');

                $students = Student::where('group_id', $groupId)->orderBy('surname')->get();

                if ($scheduleId) {
                    $existingGrades = Grade::where('schedule_id', $scheduleId)
                        ->pluck('grade', 'student_id')
                        ->toArray();

                    $grades = Grade::where('group_id', $groupId)
                        ->with(['student', 'schedule.syllabus.subject'])
                        ->get();
                }
            }
        }

        return new View('site.grades.group', [
            'grades' => $grades,
            'groups' => Group::all(),
            'subjects' => Subject::all(),
            'groupId' => $groupId,
            'subjectId' => $subjectId,
            'students' => $students,
            'scheduleId' => $scheduleId,
            'existingGrades' => $existingGrades
        ]);
    }

    // Просмотр дисциплины (Выбор дисциплин, изучаемых группой на курсе/семестре)
    public function disciplinesBySemestr(Request $request): string
    {
        $course = $request->get('course');
        $semestr = $request->get('semestr');
        $disciplines = [];

        if ($course && $semestr) {
            $disciplines = Syllabus::where('course', $course)
                ->where('semestr', $semestr)
                ->with(['subject', 'group', 'typeOfControll'])
                ->get();
        }

        return new View('site.disciplines.set_semestr', [
            'disciplines' => $disciplines,
            'course' => $course,
            'semestr' => $semestr
        ]);
    }
}