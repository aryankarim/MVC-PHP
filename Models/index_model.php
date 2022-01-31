<?php

// Gathers necessary data and returns it to the controller
class IndexModel {
    private $message = 'Welcome to Todo List App.';

    function __construct() {
    }

    // Provides data to controller
    public function welcomeMessage() {
        return $this->message;
    }
}
