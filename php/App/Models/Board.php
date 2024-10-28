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
        for ($fila = count($this->slots); $fila > 0; $fila--) {
            if ($this->slots[$fila][$column] == 0) {
                $this->slots[$fila][$column] = $player;
                break;
            }
        }
        return $this->slots;
    }

    public function checkWin(int $jugador): bool {
        // Horizontal
        for ($fila = 1; $fila <= self::FILES; $fila++) {
            for ($columna = 1; $columna <= self::COLUMNS - 3; $columna++) {
                if ($this->slots[$fila][$columna] == $jugador &&
                    $this->slots[$fila][$columna + 1] == $jugador &&
                    $this->slots[$fila][$columna + 2] == $jugador &&
                    $this->slots[$fila][$columna + 3] == $jugador) {
                    return true;
                }
            }
        }
    
        // Vertical
        for ($columna = 1; $columna <= self::COLUMNS; $columna++) {
            for ($fila = 1; $fila <= self::FILES - 3; $fila++) {
                if ($this->slots[$fila][$columna] == $jugador &&
                    $this->slots[$fila + 1][$columna] == $jugador &&
                    $this->slots[$fila + 2][$columna] == $jugador &&
                    $this->slots[$fila + 3][$columna] == $jugador) {
                    return true;
                }
            }
        }
    
        // Diagonal derecha (abajo-derecha)
        for ($fila = 1; $fila <= self::FILES - 3; $fila++) {
            for ($columna = 1; $columna <= self::COLUMNS - 3; $columna++) {
                if ($this->slots[$fila][$columna] == $jugador &&
                    $this->slots[$fila + 1][$columna + 1] == $jugador &&
                    $this->slots[$fila + 2][$columna + 2] == $jugador &&
                    $this->slots[$fila + 3][$columna + 3] == $jugador) {
                    return true;
                }
            }
        }
    
        // Diagonal izquierda (abajo-izquierda)
        for ($fila = 4; $fila <= self::FILES; $fila++) {
            for ($columna = 1; $columna <= self::COLUMNS - 3; $columna++) {
                if ($this->slots[$fila][$columna] == $jugador &&
                    $this->slots[$fila - 1][$columna + 1] == $jugador &&
                    $this->slots[$fila - 2][$columna + 2] == $jugador &&
                    $this->slots[$fila - 3][$columna + 3] == $jugador) {
                    return true;
                }
            }
        }
    
        return false; 
    }
    
    public function isValidMove(int $column): bool {
        // TODO: Comprova si el moviment és vàlid
        return $this->slots[1][$column] === 0;
    }

    public function isFull(): bool {
        // TODO: El tauler està ple?
        foreach ($this->slots as $fila) {
            foreach ($fila as $celda) {
                if ($celda == 0) {
                    return false; 
                }
            }
        }
        return true; 
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