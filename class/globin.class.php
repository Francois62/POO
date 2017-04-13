<?php

use Game\Monsters\Monster as Monster;

class Globin extends Monster{

  public function __construct(){
    $this->color = 'red';
    $this->characterType = 'Goblin';
    $this->HP = 20;
    $this->position = 50;
  }

}

?>
