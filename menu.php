<?php
session_start();
echo "Test";
if (isset($_FILES["gameStateFile"])) {
    echo "Pizza ?";
    $gameStateFile = $_FILES["gameStateFile"];
    $fileContent = file_get_contents($gameStateFile["tmp_name"]);
    $_SESSION["gameState"] = json_decode($fileContent, true); // Note: Set the second parameter to true for an associative array
    header("Location: /");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Connect 4</title>
        <style>
            <?php include 'menu.css'; ?>
        </style>
    </head>
    <body>
        <h1>Connect 4</h1>
        <h2>Menu</h2>
        <a href="/"><button>Nouvelle partie</button></a>
        <?php
        // Note: Check if $_SESSION["gameState"] is set and not empty
        if (!empty($_SESSION["gameManager"])) {
            echo "<a href='/'><button>Continuer la partie</button></a>";
        }
        ?>
        <br>
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="gameStateFile">
            <input type="submit" value="Charger une partie">
        </form>
    </body>
</html>