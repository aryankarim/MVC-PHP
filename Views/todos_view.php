<?php


// Deals with the persenation of the data
class TodosView {
    private $controller;

    function __construct($controller) {
        $this->controller = $controller;


        print "Todos - ";
    }

    //show all todos
    public function index() {

        $allTodos = $this->controller->getAllTodos();

        echo '<form method="POST" action="/MVC-PHP/todos">';
        echo 'Name: <input type="text" name="todo">';
        echo '<input type="submit">';
        echo '</form>';

        echo '<ul>';
        foreach ($allTodos as $obj) {
            $completed = $obj["completed"] ? 'yes' : 'no';
            echo '<li id=' . $obj["id"] . '>' . '<br />' . $obj["todo"] . '<br />' . 'completed: ' . $completed  . '</li><hr>';
        }
        echo '</ul>';
    }
}
