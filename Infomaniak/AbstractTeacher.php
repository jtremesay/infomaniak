<?php

namespace Infomaniak;

/**
 * Un professeur
 */
abstract class AbstractTeacher extends People {
    protected $_id = 0;
    protected $_firstName = "";
    protected $_lastName = "";


    /**
     * Récupère le salaire
     *
     * @return int
     */
    abstract public function getSalary();


    /**
     * Définit le salaire
     *
     * @param int $salary
     */
    abstract public function setSalary($salary);
}