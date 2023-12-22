<?php

require_once("power4MapGenerator.php");

/**
 * Classe définissant le déroulement du jeu, avec la victoire, la défaite, et le cours du jeu ainsi que les actions possibles
 */
class GameManager{
    public GameState $gameState;
    public static array $colors = ["Red", "Yellow", "Blue", "Green"]; // Ajouter des couleurs si besoin
    public bool $win;

    /**
     * @param GameState $gameState Variables d'état du jeu
     */
    public function __construct(GameState $gameState) {
        $this->gameState = $gameState;
        $this->win = false;
    } 

    /**
     * @param int $nbPlayer Nombre de joueurs
     * @param int $nbRow Nombre de lignes
     * @param int $nbCol Nombre de colonnes
     */
    public static function newGame(int $nbPlayer, int $nbRow, int $nbCol) {
        $playersInGame = [];
        for ($i = 0; $i < $nbPlayer; $i++) {
            $playersInGame[$i] = new Player(self::$colors[$i]);
        };
        return new GameManager(new GameState($playersInGame, power4MapGenerator::generateMap($nbCol, $nbRow)));
    }

    /**
     * @return void Change le joueur dont c'est le tour
     */
    public function nextPlayer(): void {
        $this->gameState->nextPlayer();
    }

    /**
     * Renvoie le pion à une position donnée
     * 
     * @param int $pos_x Position X du pion
     * @param int $pos_y Position Y du pion
     * @return Token Pion à la position donnée
     */
    public function getToken($pos_x, $pos_y) {
        return $this->gameState->getToken($pos_x, $pos_y);
    }

    /**
     * Vérifie la condition de victoire, pour un tableau entier
     * Extrêmement lourd : n'appeler que lors d'un load de partie !
     * Les mérites reviennent à ferdelOlmo
     * https://stackoverflow.com/questions/32770321/connect-4-check-for-a-win-algorithm
     * 
     * @param int $player Player to check for
     * @return bool True if the player has won, false otherwise
     */
    public function areFourConnectedWhole(int $player){
        $currentPlayer = $this->gameState->getCurrentPlayer();

        // horizontalCheck 
        for ($j = 0; $j<$this->gameState->getHeight()-3 ; $j++ ){
            for ($i = 0; $i<$this->gameState->getWidth(); $i++){
                if ($this->getToken($i, $j)->player == $currentPlayer && $this->getToken($i, $j+1)->player == $currentPlayer && 
                    $this->getToken($i, $j+2)->player == $currentPlayer && $this->getToken($i, $j+3)->player == $currentPlayer){
                    return true;
                }           
            }
        }

        // verticalCheck
        for ($i = 0; $i<$this->gameState->getWidth()-3 ; $i++ ){
            for ($j = 0; $j<$this->gameState->getHeight(); $j++){
                if ($this->getToken($i, $j)->player == $currentPlayer && $this->getToken($i+1, $j)->player == $currentPlayer && 
                    $this->getToken($i+2, $j)->player == $currentPlayer && $this->getToken($i+3, $j)->player == $currentPlayer){
                    return true;
                }           
            }
        }

        // ascendingDiagonalCheck 
        for ($i=3; $i<$this->gameState->getWidth(); $i++){
            for ($j=0; $j<$this->gameState->getHeight()-3; $j++){
                if ($this->getToken($i, $j)->player == $currentPlayer && $this->getToken($i-1, $j+1)->player == $currentPlayer && 
                    $this->getToken($i-2, $j+2)->player == $currentPlayer && $this->getToken($i-3, $j+3)->player == $currentPlayer){
                    return true;
                }
            }
        }

        // descendingDiagonalCheck
        for ($i=3; $i<$this->gameState->getWidth(); $i++){
            for ($j=3; $j<$this->gameState->getHeight(); $j++){
                if ($this->getToken($i, $j)->player == $currentPlayer && $this->getToken($i-1, $j-1)->player == $currentPlayer && 
                    $this->getToken($i-2, $j-2)->player == $currentPlayer && $this->getToken($i-3, $j-3)->player == $currentPlayer){
                    return true;
                }
            }
        }

        return false;
    }

    /**
     * Vérifie la condition de victoire, pour une position donnée
     * 
     * @param Token $token Pion à vérifier
     * @return bool True si le joueur a gagné, False sinon
     */
    public function areFourConnected(Token $token) {
        for ($j = $token->pos_y - 3; $j <= $token->pos_y; $j++) {
            if ($j >= 0 && $j + 3 < $this->gameState->getHeight()) {
                if ($this->getToken($token->pos_x, $j)->player == $token->player && $this->getToken($token->pos_x, $j + 1)->player == $token->player && 
                    $this->getToken($token->pos_x, $j + 2)->player == $token->player && $this->getToken($token->pos_x, $j + 3)->player == $token->player) {
                    return True;
                }
            }
        }

        for ($j = $token->pos_x - 3; $j <= $token->pos_x; $j++) {
            if ($j >= 0 && $j + 3< $this->gameState->getWidth()) {
                if ($this->getToken($j, $token->pos_y)->player == $token->player && $this->getToken($j + 1, $token->pos_y)->player == $token->player && 
                    $this->getToken($j + 2, $token->pos_y)->player == $token->player && $this->getToken($j + 3, $token->pos_y)->player == $token->player) {
                    return True;
                }
            }
        }

        for ($j = $token->pos_x - 3; $j <= $token->pos_x; $j++) {
            if ($j >= 0 && $j + 3 < $this->gameState->getWidth() && $token->pos_y + 3 < $this->gameState->getHeight()) {
                if ($this->getToken($j, $token->pos_y)->player == $token->player && $this->getToken($j + 1, $token->pos_y + 1)->player == $token->player && 
                    $this->getToken($j + 2, $token->pos_y + 2)->player == $token->player && $this->getToken($j + 3, $token->pos_y + 3)->player == $token->player) {
                    return True;
                }
            }
        }

        for ($j = $token->pos_x - 3; $j <= $token->pos_x; $j++) {
            if ($j >= 0 && $j + 3 < $this->gameState->getWidth() && $token->pos_y - 3 >= 0) {
                if ($this->getToken($j, $token->pos_y)->player == $token->player && $this->getToken($j + 1, $token->pos_y - 1)->player == $token->player && 
                    $this->getToken($j + 2, $token->pos_y - 2)->player == $token->player && $this->getToken($j + 3, $token->pos_y - 3)->player == $token->player) {
                    return True;
                }
            }
        }

        return False;
    }

    /**
     * Place un pion à une position donnée
     * 
     * @param int $pos_x Position X du pion
     * @param int $pos_y Position Y du pion
     * @return bool True si le pion a pu être placé, False sinon
     */
    public function placeToken($pos_x, $pos_y) {
        if (power4MapGenerator::placerPion($pos_x, $pos_y, $this->gameState->getCurrentPlayer(), $this->gameState->board)) {
            if ($this->areFourConnected($this->getToken($pos_x, $pos_y))) {
                $this->win = true;
            } else {
                $this->nextPlayer();
            }
            return True;
        }
        return False;
    }


    /**
     * Reset la partie
     * 
     * @return void
     */
    public function reset() {
        $this->win = false;
        $this->gameState = new GameState($this->gameState->players, power4MapGenerator::generateMap($this->gameState->getWidth(), $this->gameState->getHeight()));
    }

    /**
     * Fonction pour sauvegarder la partie en json
     * 
     * @return void
     */
    public function downloadGameState() {
        header('Content-disposition: attachment; filename=connect4-gameState.json');
        header('Content-type: application/json');
        echo $this->gameState->getGameStateAsJSON();
    }
}