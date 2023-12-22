<?php
require_once("entities.php");

$player1 = new Player("Red");
$player2 = new Player("Yellow");

$token1 = new Token($player1, 0, 0, "sprites/".$player1->color."Token.png");
$token2 = new Token($player2, 0, 0, "sprites/".$player2->color."Token.png");

$_SESSION["player1"] = $player1;
$_SESSION["player2"] = $player2;

$player1->tokens[] = $token1;

echo "HomePage";
echo "<img src='".$token1->image_path."'>";
echo "<img src='".$token2->image_path."'>";

