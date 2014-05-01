<?php

namespace Infomaniak;

/**
 * Exception lancée quand on essaye d'ajouter un étudiant à un campus vide
 */
class FullCampusException extends \OverflowException {
    public function __construct() {
        parent::__construct("The campus is full", 0, null);
    }
}