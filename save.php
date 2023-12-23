<?php
require_once("gameManager.php");
require_once("gameState.php");
session_start();

if (isset($_SESSION["gameManager"])) {
    $_SESSION["gameManager"]->downloadGameState();
}
