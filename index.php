<style>
    <?php include 'temporaryBorders.css'; ?>
</style>

<?php
require_once("gameManager.php");
require_once("gameState.php");
session_start();

if ((isset($_GET["players"]) && isset($_GET["width"]) && isset($_GET["height"]))) {
    $players = $_GET["players"];
    $width = $_GET["width"];
    $height = $_GET["height"];
    $_SESSION["gameManager"] = GameManager::newGame($players, $width, $height);
    $_SESSION["gameState"] = null;
    $_COOKIE["gameState"] = null;
}
else if (isset($_SESSION["gameManager"])){
    $gameManager = $_SESSION["gameManager"];
}
else if (isset($_SESSION["gameState"])) {
    $_SESSION["gameManager"] = new GameManager(GameState::loadGameState($_SESSION["gameState"]));
    $_SESSION["gameManager"]->checkWinUponFirstLoad();
    $_SESSION["gameState"] = NULL;
}
else if (isset($_COOKIE["gameState"])) {
    $_SESSION["gameManager"] = new GameManager(GameState::loadGameState($_COOKIE["gameState"]));
    $_SESSION["gameManager"]->checkWinUponFirstLoad();
}
else if (!isset($_SESSION["gameManager"])) {
    header('Location: /menu.php');
    exit();
}

// Reset
if (isset($_GET["reset"])) {
    $gameManager = $_SESSION["gameManager"];
    $players = $gameManager->gameState->numberOfPlayers();
    $width = $gameManager->gameState->getWidth();
    $height = $gameManager->gameState->getHeight();
    $_SESSION["gameManager"] = GameManager::newGame($players, $height, $width);
}

$gameManager = $_SESSION["gameManager"];

// Placement de token
if (isset($_GET["pos_x"]) && isset($_GET["pos_y"]) && !$gameManager->win) {
    $pos_x = $_GET["pos_x"];
    $pos_y = $_GET["pos_y"];
    $gameManager->placeToken($pos_x, $pos_y);
}

$gameState = $gameManager->gameState;
setcookie("gameState", $gameState->getGameStateAsSerial(), ["expires" => time() + 3600]);
$gameManager->checkWin();


// Retour au menu
echo "<a href='menu.php'><button>Menu</button></a>";

// Reset
echo "<a href='/?reset=1'><button>Reset</button></a>";

//Sauvegarde de la partie
echo "<a href='/save.php'><button>Sauvegarder</button></a>";

echo power4MapGenerator::generateMapHTML($gameState->board, !$gameManager->win);


