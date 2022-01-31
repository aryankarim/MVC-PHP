<?php

// Gathers necessary data and returns it to the controller
class TodosModel {
    private $todos = [];

    function __construct() {
        $getfile = file_get_contents(__DIR__ . "/DB.json");
        $decodedFile = json_decode($getfile, true);
        $this->todos = reset($decodedFile);
    }

    // Provides data to controller
    public function allTodos() {
        return $this->todos;
    }
}
