<?php

class Player 
{
    public string $color;
    public array $tokens = [];
    // public int $score; // Additional feature

    public function __construct(string $color) {
        $this->color = $color;
        $this->tokens = [];
    }
}

class Token {
    public Player $player;
    public int $pos_x;
    public int $pos_y;
    public string $image_path;

    public function __construct(Player $player, int $pos_x, int $pos_y, string $image_path) {
        $this->player = $player;
        $this->pos_x = $pos_x;
        $this->pos_y = $pos_y;
        $this->image_path = $image_path;
    }
}
?>