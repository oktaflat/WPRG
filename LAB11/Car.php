<?php
    class Car {
        public static $count = 0;
        private $model;
        private $price; // euro
        private $exchangeRate;

        function __construct($model, $price, $exchangeRate) {
            static::$count++;
            $this->setModel($model);
            $this->setPrice($price);
            $this->setExchangeRate($exchangeRate);
        }

        function setModel($model) {
            $this->model = $model;
        }

        function setPrice($price) {
            $this->price = $price;
        }

        function setExchangeRate($exchangeRate) {
            $this->exchangeRate = $exchangeRate;
        }

        function getModel() {
            return $this->model;
        }

        function getPrice() {
            return $this->price;
        }

        function getExchangeRate() {
            return $this->exchangeRate;
        }


        function value() {
            return $this->price * $this->exchangeRate;
        }

        function __toString() {
            return "Model: " . $this->model . ", " . "Price: " . $this->price . " EURO, " . "Exchange Rate: " . $this->exchangeRate . " PLN";
        }
    }
?>