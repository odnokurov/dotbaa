<?php

namespace Model;

class Syllabus
{
    private static $db;

    public static function setDb($db)
    {
        self::$db = $db;
    }

    public static function create($data)
    {
        $stmt = self::$db->prepare("
            INSERT INTO syllabus (course, semestr, group_id, subject_id, number_of_hours, control_id) 
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $data['course'],
            $data['semestr'],
            $data['group_id'],
            $data['subject_id'],
            $data['hours'] ?? null,
            $data['control_id'] ?? null
        ]);
    }

    public static function updateSemester($syllabusId, $course, $semestr)
    {
        $stmt = self::$db->prepare("UPDATE syllabus SET course = ?, semestr = ? WHERE syllabus_id = ?");
        return $stmt->execute([$course, $semestr, $syllabusId]);
    }

    public static function updateControl($syllabusId, $controlId)
    {
        $stmt = self::$db->prepare("UPDATE syllabus SET control_id = ? WHERE syllabus_id = ?");
        return $stmt->execute([$controlId, $syllabusId]);
    }

    public static function getByGroupAndSubject($groupId, $subjectId)
    {
        $stmt = self::$db->prepare("
            SELECT * FROM syllabus 
            WHERE group_id = ? AND subject_id = ?
        ");
        $stmt->execute([$groupId, $subjectId]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public static function getAllWithDetails()
    {
        $stmt = self::$db->query("
            SELECT sy.*, g.group_name, s.subject_name, tc.control_name
            FROM syllabus sy
            JOIN groups g ON sy.group_id = g.group_id
            JOIN subjects s ON sy.subject_id = s.subject_id
            LEFT JOIN type_of_control tc ON sy.control_id = tc.control_id
            ORDER BY g.group_name, s.subject_name
        ");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}