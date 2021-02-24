<?php

namespace App\Action;

use App\Application;

class Task
{
    public static function create($title, $description)
    {
        $result = Application::$db->insert(
            "tasks",
            'title, description',
            "'$title', '$description'"
        );
        if ($result) {
            return 'Task added successfully';
        }
        return 'Can\'t add Task';
    }

    public static function getAll()
    {
        $result = Application::$db->select("tasks");

        if (!$result) {
            die('Fetch failed');
        }
        $json = json_encode($result);
        return $json;
    }

    public static function search($query)
    {
        $result = Application::$db->select("tasks", "title LIKE '$query%'");
        if (!$result) {
            die("Fetch failed: $query");
        }
        $json = json_encode($result);
        return $json;
    }

    public static function get($id)
    {
        $result = Application::$db->select("tasks", "id = $id");
        if (!$result) {
            die("Can'\t fetch task");
        }
        return json_encode($result);
    }

    public static function update($id, $title, $description)
    {
        $result = Application::$db->update(
            "tasks",
            "title = '$title', description = '$description'",
            "id = $id"
        );
        if (!$result) {
            die("Can'\t edit task");
        }

        return 'Tasks edit';
    }

    public static function delete($id)
    {
        $result = Application::$db->delete("tasks", "id = '$id'");
        if (!$result) {
            die("Can'\t delete task");
        }
        return 'Tasks deleted';
    }
}