<?php

namespace Infomaniak;


/**
 * Un étudiant
 */
class Student extends People {
    protected $_id = 0;
    protected $_firstName = "";
    protected $_lastName = "";


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