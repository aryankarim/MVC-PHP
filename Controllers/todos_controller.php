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

    // Send data to model to be added
    public function addTodo($todo) {
        $this->model->addTodo($todo);
    }

    public function deleteTodo($id) {
        $this->model->deleteTodo($id);
    }
    public function getTodo($id) {
        return $this->model->getTodo($id);
    }
    public function updateTodo($id, $newTodo, $newStatus) {
        return $this->model->updateTodo($id, $newTodo, $newStatus);
    }
}
