<?php
session_start();
if (isset($_FILES["gameStateFile"])) {
    $gameStateFile = $_FILES["gameStateFile"];
    $fileContent = file_get_contents($gameStateFile["tmp_name"]);
    $_SESSION["gameState"] = $fileContent;
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
        <form action="/" method="get">
            <label for="players">Nombre de joueurs</label>
            <select name="players" id="players">
                <option value="2" selected>2</option>
                <?php for ($i = 3; $i <= 4; $i++) { echo "<option value=".$i.">".$i."</option>"; } ?>
            </select><br>
            <label for="width">Largeur du plateau</label>
            <select name="width" id="width">
                <option value="5" selected>5</option>
                <?php for ($i = 6; $i <= 12; $i++) { echo "<option value=".$i.">".$i."</option>"; } ?>
            </select><br>
            <label for="height">Hauteur du plateau</label>
            <select name="height" id="height">
                <option value="5" selected>5</option>
                <?php for ($i = 6; $i <= 12; $i++) { echo "<option value=".$i.">".$i."</option>"; } ?>
            </select><br>
            <input type="submit" value="Nouvelle partie">
        </form>
        <?php
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