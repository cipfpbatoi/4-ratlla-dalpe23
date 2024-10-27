<?php

namespace Joc4enRatlla\Controllers;
use Joc4enRatlla\Models\Player;
use Joc4enRatlla\Models\Game;
use PhpParser\Node\Expr\AssignOp\Plus;

class GameController
{
private Game $game;

// Request és l'array $_POST!!!!!!!!!!!!

public function __construct($request=null){
    // TODO: Inicialització del joc.Ha d'inicializar el Game si és la primera vegada o agafar les dades de la sessió si ja ha estat inicialitzada
 
    if (isset($request['nombre'])){
        $jugador1 = new Player($request['nombre'], $request['color']);
        $jugador2 = new Player("alvarito", "white", true);
        $this->game = new Game($jugador1, $jugador2);
        $this->game->save();     //guarda juego

    } else {
        $this->game = Game::restore();
    }
       $this->play($request);
}

public function play(Array $request)  
{
    // TODO : Gestió del joc. Ací es on s'ha de vore si hi ha guanyador, si el que juga es automàtic  o manual, s'ha polsat reiniciar...
    
    if (isset($request['columna'])){
         $this->game->play($request['columna']);
    }
   


    $board = $this->game->getBoard();
    $players = $this->game->getPlayers();
    $winner = $this->game->getWinner();
    $scores = $this->game->getScores();
    loadView('index',compact('board','players','winner','scores'));
 }
}