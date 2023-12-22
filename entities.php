<?php

/**
 * Classe définissant les joueurs
 * 
 * @param string $color Couleur du joueur
 * @param array $tokens Jetons du joueur
 * param int $score Score du joueur | Possiblement ajoutable
 */
class Player 
{
    public string $color;
    public array $tokens = [];
    // public int $score; // Additional feature

    /**
     * @param string $color Couleur du joueur
     */
    public function __construct(string $color) {
        $this->color = $color;
        $this->tokens = [];
    }
}

/**
 * Classe définissant les tokens des joueurs
 * 
 * @param Player $player Joueur auquel appartient le jeton
 * @param int $pos_x Position en x du jeton dans le plateau
 * @param int $pos_y Position en y du jeton dans le plateau
 * @param string $image_path Chemin vers l'image du jeton | Si non existante, charge l'image par défaut
 */
class Token {
    public Player $player;
    public int $pos_x;
    public int $pos_y;
    public string $image_path; // Image à charger

    /**
     * @param Player $player Joueur auquel appartient le jeton
     * @param int $pos_x Position en x du jeton
     * @param int $pos_y Position en y du jeton
     * @param string $image_path Chemin vers l'image du jeton
     */
    public function __construct(Player $player, int $pos_x, int $pos_y, string $image_path) {
        $this->player = $player;
        $this->pos_x = $pos_x;
        $this->pos_y = $pos_y;
        if (file_exists($image_path)) {
            $this->image_path = $image_path;
        } else {
            $this->image_path = "sprites/defaultToken.png";
        }
    }
}
?>