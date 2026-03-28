<?php

namespace Model;

class Schedule
{
    private static $db;

    public static function setDb($db)
    {
        self::$db = $db;
    }

    public static function getLastBySyllabus($syllabusId)
    {
        $stmt = self::$db->prepare("
            SELECT * FROM schedule 
            WHERE syllabus_id = ? 
            ORDER BY date_of_lesson DESC, lesson_number DESC 
            LIMIT 1
        ");
        $stmt->execute([$syllabusId]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}