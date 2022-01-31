<?php

class TodosController {
    private $model;

    function __construct($model) {
        $this->model = $model;
    }

    // Gets data from model to give it to View
    public function getAllTodos() {
        return $this->model->allTodos();
    }
}
