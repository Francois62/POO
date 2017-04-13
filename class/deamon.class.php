<?php

use Game\Monsters\Monster as Monster;

class Deamon extends Monster{

  public function __construct(){
    $this->color = 'green';
    $this->characterType = 'Démon';
    $this->HP = 50;
    $this->position = 50;
  }

}

?>
