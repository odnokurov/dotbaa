<?php

namespace Controller;

use Model\Student;
use Model\Group;
use Model\Subject;
use Model\Grade;
use Model\Syllabus;
use Src\View;
use Src\Request;

class GradeController
{
    // Просмотр успеваемости (Общая точка входа / выбор действия)
    public function index(): string
    {
        return new View('site.grades.set_control', [
            'students' => Student::all(),
            'groups' => Group::all()
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
            'students' => Student::all()
        ]);
    }

    // Выбор успеваемости группы (По группам и дисциплинам)
    public function gradeGroup(Request $request): string
    {
        $groupId = $request->get('group_id');
        $subjectId = $request->get('subject_id');
        $grades = [];

        if ($groupId) {
            $query = Grade::where('group_id', $groupId)->with(['student', 'schedule.syllabus.subject']);
            
            if ($subjectId) {
                $query->whereHas('schedule.syllabus', function($q) use ($subjectId) {
                    $q->where('subject_id', $subjectId);
                });
            }
            $grades = $query->get();
        }

        return new View('site.grades.group', [
            'grades' => $grades,
            'groups' => Group::all(),
            'subjects' => Subject::all()
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
                ->with(['subject', 'group'])
                ->get();
        }

        return new View('site.disciplines.set_semestr', [
            'disciplines' => $disciplines
        ]);
    }
}
