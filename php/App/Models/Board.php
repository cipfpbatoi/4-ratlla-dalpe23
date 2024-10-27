<?php
namespace Joc4enRatlla\Models;

class Board
{
    public const FILES = 6;
    public const COLUMNS = 7;
    public const DIRECTIONS = [
        [0, 1],   // Horizontal derecha
        [1, 0],   // Vertical abajo
        [1, 1],   // Diagonal abajo-derecha
        [1, -1]   // Diagonal abajo-izquierda
    ];

    private array $slots;

    public function __construct(){
        $this->slots = self::initializeBoard();
    }

    // TODO: Getters y Setters 

    private static function initializeBoard(): array  {
        $slots = []; 
        for ($i = 1; $i <= self::FILES; $i++) {  
            for ($j = 1; $j <= self::COLUMNS; $j++) {
                $slots[$i][$j] = 0;
            }
        }
        return $slots;

    }
        // TODO: Realitza un moviment en la graella
    public function setMovementOnBoard(int $column, int $player): array {
        for ($fila = count($this->slots); $fila >= 0; $fila--) {
            if ($this->slots[$fila][$column] == 0) {
                $this->slots[$fila][$column] = $player;
                break;
            }
        }
        return $this->slots;
    }

    public function checkWin(array $coord): bool {
        // TODO: Comprova si hi ha un guanyador
        return false;
    }
    public function isValidMove(int $column): bool {
        // TODO: Comprova si el moviment és vàlid
        return false;
    }

    public function isFull(): bool {
        // TODO: El tauler està ple?
        return false;
    }







    /**
    * @return array
    */
    public function getSlots(): array {
    	return $this->slots;
    }

    /**
    * @param array $slots
    */
    public function setSlots(array $slots): void {
    	$this->slots = $slots;
    }
}