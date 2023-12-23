<style>
    <?php include 'temporaryBorders.css'; ?>
</style>

<?php
require_once("gameManager.php");
require_once("gameState.php");
session_start();

if (isset($_GET["reset"])) {
    $_SESSION["gameManager"] = null;
}
if (isset($_GET["save"])) {
    $_SESSION["gameManager"] = $_SESSION["gameManager"]->downloadGameState();
}

if (isset($_SESSION["gameState"])) {
    $_SESSION["gameManager"] = new GameManager(GameState::loadGameState($_SESSION["gameState"]));
     $_SESSION["gameManager"]->areFourConnectedWhole();
    $_SESSION["gameState"] = NULL;
}

if (isset($_SESSION["gameManager"])) {
    $gameManager = $_SESSION["gameManager"];
    $gameState = $gameManager->gameState;
} else {
    $gameManager = GameManager::newGame(2, 6, 7);
    $gameState = $gameManager->gameState;
    $_SESSION["gameManager"] = $gameManager;
}

if (isset($_GET["pos_x"]) && isset($_GET["pos_y"])) {
    $pos_x = $_GET["pos_x"];
    $pos_y = $_GET["pos_y"];
    $gameManager->placeToken($pos_x, $pos_y);
    $_SESSION["gameManager"] = $gameManager;
}


echo "HomePage";
echo "<br>";
echo "<a href='menu.php'><button>Menu</button></a>";
// Reset
echo "<a href='/?reset=1'><button>Reset</button></a>";
//Sauvegarde de la partie
echo "<a href='/save.php'><button>Sauvegarder</button></a>";
//Sauvegarde de la partie local
echo "<a href='/?save=1'><button>Sauvegarder</button></a>";

echo power4MapGenerator::generateMapHTML($gameState->board, !$gameManager->win);


