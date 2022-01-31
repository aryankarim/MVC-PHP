<?php
class AboutController {
    private $modelObj;

    function __construct($model) {
        $this->modelObj = $model;
    }

    public function current() {
        return $this->modelObj->message = "About us today changed by aboutController.";
    }
}
