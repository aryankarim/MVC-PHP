<?php

// Gathers necessary data and returns it to the controller
class TodosModel {
    private $todos = [];

    function __construct() {
        $getfile = file_get_contents(__DIR__ . "/DB.json");
        $decodedFile = json_decode($getfile, true);
        $this->todos = $decodedFile;
    }

    // Provides data to controller
    public function allTodos() {
        return $this->todos;
    }


    public function addTodo($todo) {
        $tempArray = $this->todos; //the arr
        $json = array(
            "id"  => count($this->todos),
            "todo" => $todo,
            "completed" => false,
        );
        array_push($tempArray, $json);
        $jsonData = json_encode($tempArray);
        $this->todos = $tempArray;
        file_put_contents(__DIR__ . '/DB.json', $jsonData);
    }

    public function deleteTodo($id) {
        $tempArray = $this->todos;
        $tempArray = array_filter($tempArray, function ($obj) use ($id) {
            return $obj["id"] != $id;
        });
        $jsonData = json_encode($tempArray);
        $this->todos = $tempArray;
        file_put_contents(__DIR__ . '/DB.json', $jsonData);
    }

    public function getTodo($id) {
        $tempArray = $this->todos;
        $tempArray = array_filter($tempArray, function ($obj) use ($id) {
            return $obj["id"] == $id;
        });
        return reset($tempArray);
    }

    public function updateTodo($id, $newTodo, $newStatus) {
        $tempArray = $this->todos;
        $json = array(
            "id"  => $id,
            "todo" => $newTodo,
            "completed" => $newStatus,
        );
        $tempArray = array_map(function ($obj) use ($id, $json) {
            if ($obj['id'] == $id) {
                return $json;
            } else {
                return $obj;
            }
        }, $tempArray);
        $tempArray = json_encode($tempArray);
        $this->todos = $tempArray;
        file_put_contents(__DIR__ . '/DB.json', $tempArray);
    }
}
