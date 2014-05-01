<?php

namespace Infomaniak;


/**
 * Un étudiant
 */
class Student extends People {
    /**
     * Est-ce que l'étudiant possède un identifiant ?
     *
     * Si son id est 0, on considère qu'il n'a pas d'id.
     *
     * @return bool
     */
    public function hasId() {
        return $this->getId() != 0;
    }
}