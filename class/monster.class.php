<?php

namespace Game\Monsters;
use Game\Characters\Character as Character;

class Monster extends Character{

  protected $color;
  protected $monsterType;

  public function getColor(){
    return $this->color;
  }

}

?>
