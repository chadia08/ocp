<?php

namespace App\Helpers;

class SequenceGenerator{
    public static function generate()
    {       
        if (!isset($_SESSION['lastSequence'])) {
            // Si la clé n'existe pas, initialiser la séquence à 1
            $_SESSION['lastSequence'] = 1;
        } else {
            // Si la clé existe, incrémenter la séquence
            $_SESSION['lastSequence']++;
        }

        $newSequence = str_pad($_SESSION['lastSequence'], 3, '0', STR_PAD_LEFT);
        $year = date('y');
        return $newSequence . '/' . $year;
    }
}


