<?php

namespace Game\Players;
use Game\Characters\Character as Character;

class Player extends Character{

  protected $weapon;
  protected $name;

  public function getName(){
    return $this->name;
  }

  public function getWeapon(){
    return $this->weapon;
  }

}

?>
