<?php

namespace Infomaniak;


/**
 * Un campus
 */
class Campus implements \JsonSerializable {
    protected $_city = "";
    protected $_region = "";
    protected $_capacity = 0;
    protected $_students = array();
    protected $_teachers = array();


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
            throw new \InvalidArgumentException('setCity expected Argument $city to be string');
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
            throw new \InvalidArgumentException('setRegion expected Argument $region to be string');
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
            throw new \InvalidArgumentException('setCapacity expected Argument $capacity to be int');
        }

        if ($capacity < 0) {
            throw new \InvalidArgumentException("New capacity should not be negative");
        }


        // TODO : on fait quoi si la nouvelle capacité est inférieure à
        // l'occupation  actuelle du campus ?
        // En attendant d'en savoir plus, on vire les étudiants en trop
        $count = $this->countStudents();
        if ($count > $capacity) {
            $this->_students = array_splice($this->_students, $capacity);
        }

        $this->_capacity = $capacity;
    }


    /**
     * Est-ce que deux campus sont égaux ?
     *
     * @param Campus $other Le campus à comparer
     * @return bool
     */
    public function isEquals(Campus $other) {
        if ($this->getCity() != $other->getCity()) {
            return false;
        }

        if ($this->getRegion() != $other->getRegion()) {
            return false;
        }

        return true;
    }



    //-------------------------------------------------------------------------
    // Gestion des étudiants
    //-------------------------------------------------------------------------

    /**
     * Ajoute un étudiant au campus
     *
     * Ne fait rien si l'étudiant est déjà dans le campus.
     *
     */
    public function addStudent(Student $student) {
        // Pas la peine de re-ajouter un étudiant déjà dans le campus
        if ($this->studentsExists($student)) {
            return;
        }


        // Vérifie si il y a assez de place pour acceuillir l'étudiant
        if ($this->_capacity === $this->countStudents()) {
            throw new FullCampusException();
        }

        $this->_students[] = $student;
    }


    /**
     * Supprime un étudiant du campus
     *
     * @param Student $student Étudiant à supprimer
     */
    public function removeStudent(Student $student) {
        $this->_students = Helpers::array_remove($this->_students, $student);
    }


    /**
     * Est-ce que le campus contient l'étudiant ?
     *
     * @param Student $student
     * @return bool
     */
    public function studentsExists(Student $student) {
        return in_array($student, $this->_students);
    }


    /**
     * Récupère une copie des étudiants du campus
     *
     * Note : les étudiants sont triés par id croissant, les sans-id étant devant
     *
     * @return array[Student]
     */
    public function getStudents() {
        $students = Helpers::array_clone($this->_students);
        usort($students, function (Student $a, Student $b) {
            return $a->compare($b);
        });

        return $students;
    }


    /**
     * Le nombre d'étudiants dans le campus
     *
     * @return int
     */
    public function countStudents() {
        return count($this->_students);
    }



    //-------------------------------------------------------------------------
    // Gestion des professeurs
    //-------------------------------------------------------------------------


    /**
     * Ajoute un professeur au campus
     *
     * @param Teacher $teacher Le professeur à ajouter
     */
    public function addTeacher(Teacher $teacher) {
        if ($this->teacherExists($teacher)) {
            return;
        }

        $this->_teachers[] = $teacher;
    }


    /**
     * Supprime un professeur du campus
     *
     * @param Teaches $teacher Le professeur à supprimer
     */
    public function removeTeacher(Teacher $teacher) {
        $this->_teachers = Helpers::array_remove($this->_teachers, $teacher);
    }


    /**
     * Le nombre de professeurs dans le campus
     *
     * @return int
     */
    public function countTeachers() {
        return count($this->_teachers);
    }


    /**
     * Est-ce qu'un professeur est dans le campus ?
     *
     * @param Teacher $teacher Le professeur dont il faut tester l'existance
     * @return bool
     */
    public function teacherExists(Teacher $teacher) {
        return in_array($teacher, $this->_teachers);
    }

    /**
     * Récupère une copie des professeurs du campus
     *
     * return array[Teacher]
     */
    public function getTeachers() {
        return Helpers::array_clone($this->_teachers);
    }



    //--------------------------------------------------------------------------
    // JsonSerializable
    //--------------------------------------------------------------------------
    public function jsonSerialize() {
        $data = array();
        $data['city'] = $this->getCity();
        $data['region'] = $this->getRegion();
        $data['capacity'] = $this->getCapacity();
        $data['students'] = $this->getStudents();
        $data['teachers'] = $this->getTeachers();

        return $data;
    }
}