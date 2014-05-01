<?php

namespace Infomaniak;

class Student {
    protected $_id = 0;
    protected $_firstName = "";
    protected $_lastName = "";


    public function __construct() {

    }


    /**
     * Récupère l'identifiant
     *
     * @return int L'identifiant
     */
    public function getId() {
        return $this->_id;
    }


    /**
     * Définit l'identifiant
     *
     * Si l'identifiant est à 0, on considère que l'étudient n'a pas encore
     * d'identifiant.
     *
     * @param int $id L'identifiant
     */
    public function setId($id) {
        if (!is_int($id)) {
            trigger_error('setId expected Argument $id to be int', E_USER_WARNING);
        }

        $this->_id = $id;
    }


    /**
     * Est-ce que l'étudient possède un identifiant ?
     *
     * @return bool
     */
    public function hasId() {
        return $this->getId() != 0;
    }


    /**
     * Récupère le prénom
     *
     * @return string
     */
    public function getFirstName() {
        return $this->_firstName;
    }


    /**
     * Définit le prénom
     *
     * @param string $firstName Le prénom
     */
    public function setFirstName($firstName) {
        if (!is_string($firstName)) {
            trigger_error('setFirstName expected Argument $firstName to be string', E_USER_WARNING);
        }

        $this->_firstName = $firstName;
    }


    /**
     * Récupère le nom
     *
     * @return string
     */
    public function getLastName() {
        return $this->_lastName;
    }


    /**
     * Définit le nom
     *
     * @param string $lastName Le nom
     */
    public function setLastName($lastName) {
        if (!is_string($lastName)) {
            trigger_error('setLastName expected Argument $lastName to be string', E_USER_WARNING);
        }

        $this->_firstName = $lastName;
    }
}