<?php

/**
 * Classe stockant l'état du jeu et permettant son importation/exporation
 * @property array $players Joueurs du jeu
 * @property array $board Plateau de jeu
 * @property int $currentPlayerIndex Index du joueur actuel
 * @method Player getCurrentPlayer() Joueur dont c'est le tour
 */
class GameState
{ 
    public array $players = [];
    public array $board = [];
    public int $currentPlayerIndex = 0; // Index du joueur actuel

    /**
     * @param array $players Joueurs du jeu
     * @param array $board Plateau de jeu
     */
    public function __construct(array $players, array $board) {
        $this->players = $players;
        $this->board = $board;
    }

    /**
     * @return Player Joueur dont c'est le tour
     */
    public function getCurrentPlayer(): Player {
        return $this->players[$this->currentPlayerIndex];
    }

    /**
     * @return void Change le joueur dont c'est le tour
     */
    public function nextPlayer(): void {
        $this->currentPlayerIndex = ($this->currentPlayerIndex + 1) % count($this->players);
    }

    /**
     * @return int Le nombre de joueurs
     */
    public function numberOfPlayers(): int {
        return count($this->players);
    }

    /**
     * @return string Etat du jeu serialisé | Pour la sauvegarde
     */
    public function getGameStateAsSerial(): string {
        return serialize($this);
    }

    /**
     * @param string $gameStateAsSerial Etat du jeu serialisé
     * @return GameState Etat du jeu
     */
    public static function loadGameState(string $gameStateAsSerial): GameState {
        return unserialize($gameStateAsSerial);
    }

    /**
     * Renvoie le token à une position donnée
     * 
     * @param int $pos_x Position X du token
     * @param int $pos_y Position Y du token
     * @return Token|null Token à la position donnée, ou NULL si les coordonnées sont invalides
     */
    public function getToken($pos_x, $pos_y): ?Token {
        if ($pos_x < 0 || $pos_y < 0 || $pos_x >= $this->getWidth() || $pos_y >= $this->getHeight() || is_null($this->board[$pos_x][$pos_y])) {
            $token = new Token(null, $pos_x, $pos_y, "sprites/emptyToken.png");
            return $token;
        } else {
            return $this->board[$pos_x][$pos_y];
        }
    }

    /**
     * Renvoie la largeur du plateau de jeu
     * 
     * @return int Largeur du plateau de jeu
     */
    public function getWidth(): int {
        return count($this->board);
    }

    /**
     * Renvoie la hauteur du plateau de jeu
     * 
     * @return int Hauteur du plateau de jeu
     */
    public function getHeight(): int {
        return count($this->board[0]);
    }
}