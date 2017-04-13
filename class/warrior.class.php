<?php

use Game\Players\Player as Player;

class Warrior extends Player{

  public function __construct($name){
    $this->name = $name;
    $this->weapon = 'Arc';
    $this->characterType = 'Guerrier';
    $this->HP = 200;
    $this->position = 50;
  }

}

?>
