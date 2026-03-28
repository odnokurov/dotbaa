<?php

namespace Model;

class Subject
{
    private static $db;

    public static function setDb($db)
    {
        self::$db = $db;
    }

    public static function all()
    {
        $stmt = self::$db->query("SELECT * FROM subjects ORDER BY subject_name");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function find($id)
    {
        $stmt = self::$db->prepare("SELECT * FROM subjects WHERE subject_id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public static function create($data)
    {
        $stmt = self::$db->prepare("INSERT INTO subjects (subject_name) VALUES (?)");
        return $stmt->execute([$data['subject_name']]);
    }
}