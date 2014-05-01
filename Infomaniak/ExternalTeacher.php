<?php

namespace Infomaniak;

/**
 * UN professeur externe au campus
 */
class ExternalTeacher extends AbstractTeacher {
    protected $_salary = 0;

    /**
     * Récupère le salaire
     *
     * @return int
     */
    public function getSalary() {
        return $this->_salary;
    }


    /**
     * Définit le salaire
     *
     * @param int $salary
     */
    public function setSalary($salary) {
        if (!is_int($salary)) {
            trigger_error('setSalary expected Argument $salary to be int', E_USER_WARNING);
        }

        $this->_salary = $salary;
    }
}