<?php

namespace Joc4enRatlla\Controllers;
use Joc4enRatlla\Models\Player;
use Joc4enRatlla\Models\Game;
use PhpParser\Node\Expr\AssignOp\Plus;
use Joc4enRatlla\Services\Logs;

class GameController
{
private Game $game;
private Logs $log;
// Request és l'array $_POST!!!!!!!!!!!!

public function __construct($request=null){
    // TODO: Inicialització del joc.Ha d'inicializar el Game si és la primera vegada o agafar les dades de la sessió si ja ha estat inicialitzada

    if (isset($request['nombre'])){
        $jugador1 = new Player($request['nombre'], $request['color']);
        $jugador2 = new Player("Alvarito", "purple", true);
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

    $error = "";
    
    if (!$this->game->getBoard()->isFull() && !$this->game->getWinner()) {

        $jugadorActual = $this->game->getPlayers()[$this->game->getNextPlayer()];       //cada jugador para luego ver si uno es autom. o no
        $log = new Logs();
            
        if (!$jugadorActual->getIsAutomatic() && isset($request['columna'])) {
            try{
                $this->game->play($request['columna']);         //NORMAL
                $log->getLog()->info("El jugador ".$jugadorActual->getName()." mueve a la columna ".$request['columna']);
            }catch(\Exception $err){
                $log->getLog()->error("Error, columna ".$request['columna']."llena."); 
            }
        }

        elseif ($jugadorActual->getIsAutomatic()) {
            $columna = $this->game->playAutomatic();
            $log->getLog()->info("El jugador ".$jugadorActual->getName()." mueve a la columna ".$columna);
        }
    }

    if (isset($request['reset'])) {
        $this->game->reset();
        $this->game->save();
    }
    if (isset($request['exit'])) {
        unset($_SESSION['game']);
        session_destroy();
        header("location:/index.php");
        exit();
    }

    $board = $this->game->getBoard();
    $players = $this->game->getPlayers();
    $winner = $this->game->getWinner();
    $scores = $this->game->getScores();

    loadView('index',compact('board','players','winner','scores'));
 }

} 

