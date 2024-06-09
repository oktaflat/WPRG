<?php

require_once "Car.php";
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
?>