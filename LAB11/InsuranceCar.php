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

class NewCar extends Car {
    private $alarm;
    private $radio;
    private $climatronic;

    function __construct($model, $price, $exchangeRate, $alarm, $radio, $climatronic) {
        static::$count++;
        $this->setModel($model);
        $this->setPrice($price);
        $this->setExchangeRate($exchangeRate);
        $this->setAlarm($alarm);
        $this->setRadio($radio);
        $this->setClimatronic($climatronic);
    }

    function setAlarm($alarm) {
        $this->alarm = (bool) $alarm;
    }

    function setRadio($radio) {
        $this->radio = (bool) $radio;
    }

    function setClimatronic($climatronic) {
        $this->climatronic = (bool) $climatronic;
    }

    function getAlarm() {
        if($this->alarm == true)
            return "Yes";
        else
            return "No";
    }

    function getRadio() {
        if($this->radio == true)
            return "Yes";
        else
            return "No";
    }

    function getClimatronic() {
        if($this->climatronic == true)
            return "Yes";
        else
            return "No";
    }


    function value() {
        $value = $this->getPrice();
        if($this->alarm == true)
            $value = $value * 1.05;
        if($this->radio == true)
            $value = $value * 1.075;
        if($this->climatronic == true)
            $value = $value * 1.1;
        return $value;
    }

    function __toString() {
        return parent::__toString() . ", Alarm: " . $this->getAlarm() . ", Radio: " . $this->getRadio() . ", Climatronic: " . $this->getClimatronic();
    }
}

class InsuranceCar extends NewCar {
    private $firstOwner;
    private $years;

    function __construct($model, $price, $exchangeRate, $alarm, $radio, $climatronic, $firstOwner, $years) {
        static::$count++;
        $this->setModel($model);
        $this->setPrice($price);
        $this->setExchangeRate($exchangeRate);
        $this->setAlarm($alarm);
        $this->setRadio($radio);
        $this->setClimatronic($climatronic);
        $this->setFirstOwner($firstOwner);
        $this->setYears($years);
    }

    function setFirstOwner($firstOwner) {
        $this->firstOwner = (bool) $firstOwner;
    }

    function setYears($years) {
        $this->years = $years;
    }

    function getFirstOwner() {
        if ($this->firstOwner == true)
            return "Yes";
        else
            return "No";
    }

    function getYears() {
        return $this->years;
    }

    function value() {
        if($this->firstOwner == true)
            return $this->getPrice() - ($this->getYears() * 0.01 + $this->getPrice() * 0.05);
    }

    function __toString() {
        return parent::__toString() . ", First Owner: " . $this->getFirstOwner() . ", Years: " . $this->years;
    }
}
?>