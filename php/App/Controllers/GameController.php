<?php

namespace Joc4enRatlla\Controllers;
use Joc4enRatlla\Models\Player;
use Joc4enRatlla\Models\Game;
use PhpParser\Node\Expr\AssignOp\Plus;

class GameController
{
private Game $game;

// Request és l'array $_POST

public function __construct($request=null){
    //Inicialització del joc con el post que pone nombre y color
 
    if (isset($request['nombre'])){
        $jugador1 = new Player($request['nombre'], $request['color']);
        $jugador2 = new Player("alvarito", "magenta", true);
        $this->game = new Game($jugador1, $jugador2);
    }
       $this->play($request);
}
}

public function play(Array $request)  
{
    // Gestió del joc...

    $board = $this->game->getBoard();
    $players = $this->game->getPlayers();
    $winner = $this->game->getWinner();
    $scores = $this->game->getScores();
    dd($this);
    loadView('index',compact('board','players','winner','scores'));
 }
}