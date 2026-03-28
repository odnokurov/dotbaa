<?php

namespace Model;

class Grade
{
    private static $db;

    public static function setDb($db)
    {
        self::$db = $db;
    }

    public static function save($studentId, $scheduleId, $grade)
    {
        $stmt = self::$db->prepare("
            INSERT INTO grades (grade, student_id, schedule_id) 
            VALUES (?, ?, ?)
            ON DUPLICATE KEY UPDATE grade = ?
        ");
        return $stmt->execute([$grade, $studentId, $scheduleId, $grade]);
    }

    public static function getBySchedule($scheduleId)
    {
        $stmt = self::$db->prepare("
            SELECT student_id, grade 
            FROM grades 
            WHERE schedule_id = ?
        ");
        $stmt->execute([$scheduleId]);
        return $stmt->fetchAll(\PDO::FETCH_KEY_PAIR);
    }
}