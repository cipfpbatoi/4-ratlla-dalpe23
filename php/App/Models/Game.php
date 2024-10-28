<?php
namespace Joc4enRatlla\Models;

use Exception;
use Joc4enRatlla\Models\Board;
use Joc4enRatlla\Models\Player;
use SebastianBergmann\LinesOfCode\IllogicalValuesException;

class Game
{
    private Board $board;
    private int $nextPlayer;
    private array $players;
    private ?Player $winner;
    private array $scores = [1 => 0, 2 => 0];

        // TODO: S'han d'inicialitzar les variables tenint en compte que el array de jugador ha de començar amb l'index 1 
    public function __construct( Player $jugador1, Player $jugador2){
        $this->board = new Board();
        $this->players = [1=> $jugador1, 2=> $jugador2];
        $this->nextPlayer = 1;
        $this->winner = null;
    }

    // TODO: getters i setters

    public function reset(): void{
        // TODO: Reinicia el joc
        $this->board = new Board();
        $this->nextPlayer = 1;
        $this->winner = null;
    }
    public function play($columna){
        // TODO: Realitza un moviment
        if (!$this->board->isValidMove($columna)){
            throw new Exception("Movimiento no valido");
        }
        $this->board->setMovementOnBoard($columna, $this->nextPlayer);

        if ($this->board->checkWin($this->nextPlayer)){
            $this->winner = $this->players[$this->nextPlayer];
            $this->scores[$this->nextPlayer]++;

        } else {
             $this->nextPlayer = ($this->nextPlayer == 1) ? 2 : 1;
        }
        $this->save();
    }

    public function save(){
        // TODO: Guarda l'estat del joc a les sessions
        $_SESSION['game'] = serialize($this);
    }
    public static function restore(){
        // TODO: Restaura l'estat del joc de les sessions la partida de antes
        if(isset ($_SESSION['game'])){
            return unserialize($_SESSION['game'], [Game::class]);
        }
    }


    /**
    * Realitza moviment automàtic
    * @return void
    */                                          
    public function playAutomatic(){
        $opponent = $this->nextPlayer === 1 ? 2 : 1;

        for ($col = 1; $col <= Board::COLUMNS; $col++) {
            if ($this->board->isValidMove($col)) {
                $tempBoard = clone($this->board);
                $coord = $tempBoard->setMovementOnBoard($col, $this->nextPlayer);

                if ($tempBoard->checkWin($this->nextPlayer)) {
                    $this->play($col);
                    return;
                }
            }
        }

        for ($col = 1; $col <= Board::COLUMNS; $col++) {
            if ($this->board->isValidMove($col)) {
                $tempBoard = clone($this->board);
                $coord = $tempBoard->setMovementOnBoard($col, $opponent);
                if ($tempBoard->checkWin($this->nextPlayer )) {
                    $this->play($col);
                    return;
                }
            }
        }

        $possibles = array();
        for ($col = 1; $col <= Board::COLUMNS; $col++) {
            if ($this->board->isValidMove($col)) {
                $possibles[] = $col;
            }
        }
      
        $random = count($possibles)>1?rand(-1,1):0;
        $middle = (int) (count($possibles) / 2)+$random;
        $inthemiddle = $possibles[$middle];
        $this->play($inthemiddle);
        return $inthemiddle;
    }

    

    /**
    * @return Board
    */
    public function getBoard(): Board {
    	return $this->board;
    }

    /**
    * @param Board $board
    */
    public function setBoard(Board $board): void {
    	$this->board = $board;
    }

    /**
    * @return array
    */
    public function getPlayers(): array {
    	return $this->players;
    }

    /**
    * @param array $players
    */
    public function setPlayers(array $players): void {
    	$this->players = $players;
    }

    /**
    * @return Player
    */
    public function getWinner(): ?Player {
    	return $this->winner;
    }

    /**
    * @param Player $winner
    */
    public function setWinner(Player $winner): void {
    	$this->winner = $winner;
    }

    /**
    * @return array
    */
    public function getScores(): array {
    	return $this->scores;
    }

    /**
    * @param array $scores
    */
    public function setScores(array $scores): void {
    	$this->scores = $scores;
    }

    /**
    * @return int
    */
    public function getNextPlayer(): int {
    	return $this->nextPlayer;
    }
}