<?php

namespace Model;

class Group
{
    private static $db;

    public static function setDb($db)
    {
        self::$db = $db;
    }

    public static function all()
    {
        $stmt = self::$db->query("SELECT * FROM groups ORDER BY group_name");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function find($id)
    {
        $stmt = self::$db->prepare("SELECT * FROM groups WHERE group_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public static function create($data)
    {
        $stmt = self::$db->prepare("INSERT INTO groups (group_name) VALUES (?)");
        return $stmt->execute([$data['group_name']]);
    }

    public static function getStudents($groupId)
    {
        $stmt = self::$db->prepare("SELECT * FROM students WHERE group_id = ? ORDER BY surname");
        $stmt->execute([$groupId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function getSubjects($groupId)
    {
        $stmt = self::$db->prepare("
            SELECT s.*, sy.course, sy.semestr, sy.syllabus_id, tc.control_name
            FROM syllabus sy
            JOIN subjects s ON sy.subject_id = s.subject_id
            LEFT JOIN type_of_control tc ON sy.control_id = tc.control_id
            WHERE sy.group_id = ?
        ");
        $stmt->execute([$groupId]);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}