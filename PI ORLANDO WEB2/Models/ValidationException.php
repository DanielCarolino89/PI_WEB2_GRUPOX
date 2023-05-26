<?php

class ValidationException extends Exception{
    protected $errors;

    public function __construct($message = "", $errors = []) {
        parent::__construct($message, 0, null);
        $this->errors = $errors;
    }

    public function getErrors() {
        return $this->errors;
    }
}

?>