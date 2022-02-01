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
        var_dump($tempArray);
        $jsonData = json_encode($tempArray);
        $this->todos = $tempArray;
        file_put_contents(__DIR__ . '/DB.json', $jsonData);
    }
}
