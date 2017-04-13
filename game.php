<?php

header('Content-Type: text/html; charset=utf-8');

include 'inc/common.inc.php';
use Game\PLayers, Game\Monsters;

?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Game</title>
    <style>
      *{
        margin:0;
        padding:0;
      }
      body,
      html{
        position:relative;
        text-align:center;
        height:100%;
      }
      label{
        display:block;
      }
      h1{
        color:navy;
        font-size:1.5em;
        margin-bottom:10px;
      }
      hr{
        margin:10px 0 10px 0;
      }
      input,
      select{
        width:200px;
      }
      input[type="submit"]{
        display:block;
        margin:30px auto 0 auto;
      }
      .character{
        position:absolute;
        display:flex;
        flex-direction:column;
        justify-content:center;
        padding:20px;
        border:2px solid lightgrey;
        border-radius:10px;
        height:150px;
      }
      #player{
        left:100px;
      }
      #ennemi{
        right:100px;
      }
      #action{
        margin-top:50px;
        display:flex;
        flex-direction:column;
        justify-content:center;
        padding:70px 20px 20px 20px;
        height:150px;
        width:200px;
        margin:auto;
      }
      #action span{
        color:red;
        font-weight:400;
      }
      #action p{
        font-family:sans-serif;
        font-weight:100;
      }
      a{
        display:inline-block;
        padding:10px 20px 10px 20px;
        margin-bottom:20px;
        border:1px dotted red;
        border-radius:10px;
        text-decoration:none;
        color:darkred;
      }
      a:hover{
        background-color:red;
        color:white;
      }
      #reboot{
        position:absolute;
        right:100px;
        bottom:30px;
      }
      form{
        margin:50px auto 0 auto;
        padding:20px;
        border:1px dotted lightgrey;
        border-radius:10px;
        width:200px;
      }
    </style>
  </head>
  <body>
    <?php
    if((isset($_POST['send']) && isset($_POST['name'])) || isset($_GET['action'])):

      // Instance
      if(isset($_GET['player'])){
        $player = unserialize(base64_decode($_GET['player']));
        $monster = unserialize(base64_decode($_GET['monster']));

        if($_GET['action']) $player->move($monster);
        else $player->attack($monster, rand(0, 10));
      }
      else {
        if($_POST['character']) $player = new Warrior($_POST['name']);
        else $player = new Hero($_POST['name']);
      }

    ?>
    <div class="character" id="player" style="top:<?= $player->getPos() ?>px">
      <div>
        <h1>Joueur : <?= $player->getName() ?></h1>
        <p>
          Vous avez choisi un <?= $player->getCharacterType() ?><br />
          Votre arme est <?= ($player->getCharacterType() == 'Guerrier' ? 'une ' : 'un ') . $player->getWeapon() ?>
        </p>
        <hr />
        Point de vie : <?= $player->getHp() ?>
      </div>
    </div>
    <?php

    if(isset($_GET['monster'])){
      if(rand(0, 1)) $monster->move($player);
      else $monster->attack($player, rand(0, 5));
    }
    else {
      $rand = rand(0, 1);
      if($rand) $monster = new Globin();
      else $monster = new Deamon();
    }

    ?>
    <div class="character" id="ennemi" style="border-color:<?= $monster->getColor() ?>;top:<?= $monster->getPos() ?>px">
      <div>
        <h1>Ennemi : <?= $monster->getCharacterType() ?></h1>
        <hr />
        Point de vie : <?= $monster->getHp() ?>
      </div>
    </div>
    <div id="action">
      <?php
      if($player->getHp() <= 0):
      ?>
      <p>
        Le <span><?= $monster->getCharacterType() ?></span> a gagné la partie !
      </p>
      <?php
      elseif($monster->getHp() <= 0):
      ?>
      <p>
        Bravo <span><?= $player->getName() ?></span> vous avez gagné !
      </p>
      <?php
      else:
      ?>
      <a href="?monster=<?= base64_encode(serialize($monster)) ?>&player==<?= base64_encode(serialize($player)) ?>&action=0">Attaquer</a>
      <br /><br />
      <a href="?monster=<?= base64_encode(serialize($monster)) ?>&player==<?= base64_encode(serialize($player)) ?>&action=1">Se déplacer</a>

      <?php
      if(empty($_POST['send'])):
      ?>
      <p>
        Vous avez infligé
        <span>
        <?= $monster->getDamage() ?> point<?= ($monster->getDamage() > 1) ? 's' : '' ?>
        </span>
        au <?= $monster->getCharacterType() ?>
        <br />
        Il vous a infligé
        <span>
        <?= $player->getDamage() ?> point<?= ($player->getDamage() > 1) ? 's' : '' ?>
        </span>
        en retour
      </p>
      <?php
      endif;
      endif;
      ?>
    </div>
    <div id="reboot">
      <a href="./game.php">
        <?php
        if($player->getHp() <= 0 || $monster->getHp() <= 0):
        ?>
        Nouvelle partie
        <?php
        else:
        ?>
        Arrêter la partie
        <?php
        endif;
        ?>
      </a>
    </div>
    <?php
    else:
    ?>
    <form action="game.php" method="post">
      <label for="name">Entrez un nom</label>
      <input name="name" id="name" type="text" required="require"/>
      <label for="character">Type de personnage</label>
      <select name="character" id="character">
        <option value="0">Héro</option>
        <option value="1">Guerrier</option>
      </select>
      <input name="send" type="submit" value="Commencer" />
    </form>
    <?php
    endif;
    ?>
  </body>
</html>
