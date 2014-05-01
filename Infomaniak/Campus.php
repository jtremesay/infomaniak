<?php

namespace Infomaniak;

/**
 * Un campus
 */
class Campus {
    protected $_city = "";
    protected $_region = "";
    protected $_capacity = 0;
    protected $_students = array();


    public function __construct() {
    }


    /**
     * Réupère le nom de la ville
     *
     * @return string Le nom de la ville
     */
    public function getCity() {
        return $this->_city;
    }


    /**
     * Définit le nom de la ville
     *
     * @param string $city Le nom de la ville
     */
    public function setCity($city) {
        if (!is_string($city)) {
            trigger_error('setCity expected Argument $city to be string', E_USER_WARNING);
        }

        $this->_city = $city;
    }


    /**
     * Réupère le nom de la région
     *
     * @return string Le nom de la région
     */
    public function getRegion() {
        return $this->_region;
    }


    /**
     * Définit le nom de la région
     *
     * @param string $region Le nom de la région
     */
    public function setRegion($region) {
        if (!is_string($region)) {
            trigger_error('setRegion expected Argument $region to be string', E_USER_WARNING);
        }

        $this->_region = $region;
    }


    /**
     * Réupère la capacité
     *
     * @return int La capacité
     */
    public function getCapacity() {
        return $this->_capacity;
    }


    /**
     * Définit la capacité du campus en nombre d'étudiant
     *
     * Une capacité de 0 correspond à un campus sans limite de place.
     * Une capacité négative est automatiquement transformée en une capacité de
     * de 0
     *
     * @param int $capacity La capacité
     */
    public function setCapacity($capacity) {
        if (!is_int($capacity)) {
            trigger_error('setCapacity expected Argument $capacity to be int', E_USER_WARNING);
        }

        if ($capacity < 0) {
            throw new \InvalidArgumentException("New capacity should not be negative");
        }


        // TODO : on fait quoi si la nouvelle capacité est inférieure à
        // l'occupation  actuelle du campus ?
        // En attendant d'en savoir plus, on vire les étudiants en trop
        $count = $this->count();
        if ($count > $capacity) {
            $this->_students = array_splice($this->_students, $capacity);
        }

        $this->_capacity = $capacity;
    }


    /**
     * Ajoute un étudiant au campus
     *
     * Ne fait rien si l'étudiant est déjà dans le campus.
     *
     */
    public function addStudent(Student $student) {
        // Pas la peine de re-ajouter un étudiant déjà dans le campus
        if ($this->containsStudent($student)) {
            return;
        }


        // Vérifie si il y a assez de place pour acceuillir l'étudiant
        if ($this->_capacity === $this->count()) {
            throw new FullCampusException();
        }

        $this->_students[] = $student;
    }


    /**
     * Est-ce que le campus contient l'étudiant ?
     *
     * @param Student $student
     * @return bool
     */
    public function containsStudent(Student $student) {
        return in_array($student, $this->_students);
    }


    /**
     * Le nombre d'étudiants dans le campus
     *
     * @return int
     */
    public function count() {
        return count($this->_students);
    }


}