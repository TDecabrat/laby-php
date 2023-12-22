<style>
    <?php include 'temporaryBorders.css'; ?>
</style>

<?php
require_once("entities.php");
require_once("gameState.php");
require_once("power4MapGenerator.php");


$player1 = new Player("Red");
$player2 = new Player("Yellow");
$player3 = new Player("Blue");

$gameState = new GameState([$player1, $player2, $player3], power4MapGenerator::generateMap(7,7));

$_SESSION["player1"] = $player1;
$_SESSION["player2"] = $player2;
$_SESSION["player3"] = $player3;

for ($i = 0; $i < 7; $i++) {
    for ($j = 0; $j < 7; $j++) {
        power4MapGenerator::placerPion($i, $j, $gameState->players[array_rand($gameState->players)], $gameState->board);
    }
}


echo "HomePage";
echo "<br>";
echo power4MapGenerator::generateMapHTML($gameState->board);


