<?php

namespace Model;

class Student
{
    private static $db;

    public static function setDb($db)
    {
        self::$db = $db;
    }

    public static function all()
    {
        $stmt = self::$db->query("
            SELECT s.*, g.group_name 
            FROM students s 
            LEFT JOIN groups g ON s.group_id = g.group_id 
            ORDER BY s.surname
        ");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function find($id)
    {
        $stmt = self::$db->prepare("
            SELECT s.*, g.group_name 
            FROM students s 
            LEFT JOIN groups g ON s.group_id = g.group_id 
            WHERE s.student_id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public static function create($data)
    {
        $stmt = self::$db->prepare("
            INSERT INTO students (surname, name, patronymic, gender, birthday, address, group_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $data['surname'],
            $data['name'],
            $data['patronymic'] ?? null,
            $data['gender'] ?? null,
            $data['birthday'] ?? null,
            $data['address'] ?? null,
            $data['group_id'] ?? null
        ]);
    }

    public static function updateGroup($studentId, $groupId)
    {
        $stmt = self::$db->prepare("UPDATE students SET group_id = ? WHERE student_id = ?");
        return $stmt->execute([$groupId, $studentId]);
    }

    public static function getGrades($studentId)
    {
        $stmt = self::$db->prepare("
            SELECT gr.grade, gr.schedule_id, sc.date_of_lesson, sc.lesson_number,
                   sub.subject_name, sy.course, sy.semestr, tc.control_name
            FROM grades gr
            JOIN schedule sc ON gr.schedule_id = sc.schedule_id
            JOIN syllabus sy ON sc.syllabus_id = sy.syllabus_id
            JOIN subjects sub ON sy.subject_id = sub.subject_id
            LEFT JOIN type_of_control tc ON sy.control_id = tc.control_id
            WHERE gr.student_id = ?
            ORDER BY sc.date_of_lesson DESC, sc.lesson_number DESC
        ");
        $stmt->execute([$studentId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
