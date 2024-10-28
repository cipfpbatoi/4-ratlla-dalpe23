<?php 
namespace Joc4enRatlla\Models;


class Player {
    private $name;      // Nom del jugador
    private $color;     // Color de les fitxes
    private $isAutomatic; // Forma de jugar (automàtica/manual)
    
    function __construct($name, $color, $isAutomatic = false) {
    	$this->name = $name;
    	$this->color = $color;
    	$this->isAutomatic = $isAutomatic; 
    }

    // TODO: Getters i Setters 

    public function getName() {
    	return $this->name;
    }
    

    /**
    * @param $name
    */
    public function setName($name) {
    	$this->name = $name;
        return $this;
    }

    public function getColor() {
    	return $this->color;
    }

    /**
    * @param $color
    */
    public function setColor($color) {
    	$this->color = $color;
        return $this;
    }

    public function getIsAutomatic() {
    	return $this->isAutomatic;
    }

    /**
    * @param $isAutomatic
    */
    public function setIsAutomatic($isAutomatic) {
    	$this->isAutomatic = $isAutomatic;
        return $this;
    }

    /**
     * @return string
     */
    public function __toString() {
    	return "Name: {$this->name}, Color: {$this->color}, IsAutomatic: {$this->isAutomatic}";
    }
}