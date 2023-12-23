<?php
require_once("entities.php");

/**
 * Cette classe génère le terrain de jeu et les actions liées à la map
 */
class power4MapGenerator{

    /**
     * Génère une map de jeu à partir d'une largeur et d'une hauteur
     * 
     * @param int $width Largeur de la map
     * @param int $height Hauteur de la map
     * @return array $map Tableau 2D représentant la map
     */
    public static function generateMap(int $width, int $height) {
        $map = [];
        for ($i = 0; $i < $width; $i++) {
            $map[$i] = [];
            for ($j = 0; $j < $height; $j++) {
                $map[$i][$j] = NULL;
            }
        }
        return $map;
    }

    /**
     * Génère le code HTML de la map du jeu
     * 
     * @param array $map Tableau 2D représentant la map
     */
    public static function generateMapHTML(array $map, bool $isClickable = True) {
        echo "<table>";
        for ($i = 0; $i < count($map); $i++) {
            echo "<tr>";
            for ($j = 0; $j < count($map[$i]); $j++) {
                echo "<td>";
                if (is_null($map[$i][$j])) {
                    if ($isClickable){
                        echo "<a href='index.php?pos_x=".$i."&pos_y=".$j."'><img src='sprites/emptyToken.png'></a>";
                    } else {
                        echo "<img src='sprites/emptyToken.png'>";
                    }
                } else {
                    echo "<img src='".$map[$i][$j]->image_path."'>";
                }
                echo "</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }

    /**
     * Effectue une action à des coordonnées données
     * Renvoie True si un pion a pu être posé, False sinon
     * 
     * @param int $pos_x Position X du pion
     * @param int $pos_y Position Y du pion
     * @param Player $player Joueur qui pose le pion
     * @param array $map Tableau 2D représentant la map | Passé par référence
     * @return bool True si un pion a pu être posé, False sinon
     */
    public static function placerPion(int $pos_x, int $pos_y, Player $player, array &$map) {
        if (is_null($map[$pos_x][$pos_y])) {
            $token = new Token($player, $pos_x, $pos_y, "sprites/".$player->color."Token.png");
            $map[$pos_x][$pos_y] = $token;
            return True;
        } else {
            return False;
        }
    }

    /**
     * Effectue une action à des coordonnées données
     * Renvoie le tableau si un pion a pu être posé, NULL sinon
     * (Version sans passage par référence, si nécessaire)
     * 
     * @param int $pos_x Position X du pion
     * @param int $pos_y Position Y du pion
     * @param Player $player Joueur qui pose le pion
     * @param array $map Tableau 2D représentant la map
     * @return ?array Map si un pion a pu être posé, NULL sinon
     */
    public static function placerPionSansReference(int $pos_x, int $pos_y, Player $player, array $map) {
        if (is_null($map[$pos_x][$pos_y])) {
            $new_map = clone $map;
            $token = new Token($player, $pos_x, $pos_y, "sprites/".$player->color."Token.png");
            $new_map[$pos_x][$pos_y] = $token;
            $player->addToken($token);
            return $new_map;
        } else {
            return NULL;
        }
    }

    
    
}