<?php
/**
 * Define a custom exception class
 */
class DatabaseException extends Exception {

    public function __construct($message, $code = 4, Exception $previous = null) {
    
        // make sure everything is assigned properly
        parent::__construct($message, $code, $previous);
    }

    // custom string representation of object
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }
}

?>