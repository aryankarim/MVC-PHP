<?php


// Deals with the persenation of the data
class IndexView {
    private $controller;

    function __construct($controller) {
        $this->controller = $controller;


        print "Home - ";
    }

    //
    public function index() {
        return $this->controller->sayWelcome();
    }
}
