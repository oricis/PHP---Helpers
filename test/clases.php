<?php

class Gato {
    public static $id = 0;
    public $peso   = NULL;
    public $edad   = NULL;
    public $nombre = NULL;
    public $color  = 'negro';

    public function __construct($edad) {
        $this->edad = $edad;
        self::$id ++;
    }
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    public function setColor($color) {
        $this->color = $color;
    }
    public function setPeso($peso) {
        $this->peso = $peso;
    }
}

class Vaca {
    public static $id = 0;
    public $edad  = NULL;
    public $color = 'negro';

    public function __construct($edad) {
        $this->edad = $edad;
        self::$id ++;
    }
    public function setColor($color) {
        $this->color = $color;
    }
}