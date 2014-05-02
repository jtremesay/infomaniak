<?php

namespace Infomaniak;

/**
 * Un professeur externe au campus
 */
class ExternalTeacher extends Teacher {
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

        // TODO : que faire en cas de salaire négatif ?
        // Lever une exception ou clamper ?

        $this->_salary = $salary;
    }



    //--------------------------------------------------------------------------
    // JsonSerializable
    //--------------------------------------------------------------------------
    public function jsonSerialize() {
        $data = parent::jsonSerialize();
        $data['type'] = "external";

        return $data;
    }
}