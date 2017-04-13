<?php

use Game\Players\Player as Player;

class Hero extends Player{

  public function __construct($name){
    $this->name = $name;
    $this->weapon = 'Epée';
    $this->characterType = 'Héro';
    $this->HP = 100;
    $this->position = 50;
  }

}

?>
