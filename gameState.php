<?php

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
     * @return string Etat du jeu au format JSON | Pour la sauvegarde
     */
    public function getGameState() {
        return json_encode($this);
    }

    /**
     * @param string $gameStateAsJson Etat du jeu au format JSON
     * @return GameState Etat du jeu
     */
    public static function loadGameState(string $gameStateAsJson): GameState {
        return json_decode($gameStateAsJson);
    }
}