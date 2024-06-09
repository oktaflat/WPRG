<?php
    class User {
        public $message = "";

        function __construct() {
            $this->message="This is a message from ";
        }

        function changeMessage($mes) {
            $this->message=$mes;
        }

        function introduce($name): string {
            return $this->message . $name;
        }
    }

    $standard = new User();
    echo $standard->introduce("Tomomo");
    echo "\n";
    $alternate = new User();
    $alternate->changeMessage("Hamster -> ");
    echo $alternate->introduce("Kohane");
?>