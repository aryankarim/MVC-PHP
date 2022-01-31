<?php

class IndexController {
    private $model;

    function __construct($model) {
        $this->model = $model;
    }

    // Gets data from model to give it to View
    public function sayWelcome() {
        return $this->model->welcomeMessage();
    }
}
