<?php

namespace Game\Characters;

class Character{

  protected $characterType;
  protected $HP;
  protected $position;
  private $damage;

  public function move($obj){
    $this->setPos();
    $obj->damage = 0;
  }

  public function attack($obj, $health){
    $obj->setHp($health);
    $obj->damage = $health;
  }

  public function setHp($health){
    $this->HP -= $health;
  }

  private function setPos(){
    $this->position = rand(50, 300);
  }

  public function getPos(){
    return $this->position;
  }

  public function getDamage(){
    return $this->damage;
  }

  public function getCharacterType(){
    return $this->characterType;
  }

  public function getHp(){
    return $this->HP;
  }

}

?>
