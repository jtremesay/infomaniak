<?php

namespace Infomaniak;

/**
 * Un professeur interne au campus
 */
class InternalTeacher extends AbstractTeacher {
    static protected $_salary = 0;

    /**
     * Récupère le salaire
     *
     * @return int
     */
    public function getSalary() {
        return static::$_salary;
    }


    /**
     * Définit le salaire
     *
     * Note : le salaire est commun à tous les InternalTeacher.
     *
     * @param int $salary
     */
    public function setSalary($salary) {
        if (!is_int($salary)) {
            trigger_error('setSalary expected Argument $salary to be int', E_USER_WARNING);
        }

        static::$_salary = $salary;
    }
}