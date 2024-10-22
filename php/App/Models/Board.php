<?php
namespace Joc4enRatlla\Models;
    const FILES = 6;
    const COLUMNS = 7;
    const DIRECTIONS = [
        [0, 1],   // Horizontal derecha
        [1, 0],   // Vertical abajo
        [1, 1],   // Diagonal abajo-derecha
        [1, -1]   // Diagonal abajo-izquierda
    ];

class Board
{


    private array $slots;

    public function __construct(){
        
    }

    // Getters i Setters 

    private static function initializeBoard(): array  {
        $slots = [];
        for ($i = 1; $i <= FILES; $i++) {
            for ($j = 1; $j <= COLUMNS; $j++) {
                $array[$i][$j] = 0;
            }
        }
        return $slots;
    }

    //Realitza un moviment en la graella
    public function setMovementOnBoard(int $column, int $player): array {
        for ($fila = count(self::$slots) - 1; $fila >= 0; $fila--) {
            if (self::$slots[$fila][$column] == 0) {
                $slots[$fila][$column] = $player;
                return $slots;
            }
        }
    }

    //Comprova si hi ha un guanyador
    public function checkWin(array $coord): bool {
        return false;
    }

    //Comprova si el moviment és vàlid
    public function isValidMove(int $column): bool {
        return false;
        
    }


}