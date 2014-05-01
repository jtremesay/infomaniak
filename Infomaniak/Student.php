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


    /**
     * Compare deux étudiants
     *
     * Si valeur retournée = 0, les objets sons équivalents
     * Si valeur retournée < 0, $this est plus petit
     * Si valeur retournée > 0, $other plus petit
     *
     * @param Student $other L'étudiant à comparer
     * @return int
     */
    public function compare(Student $other) {
        if ($this->hasId()) {
            if ($other->hasId()) {
                return $this->getId() - $other->getId();
            } else {
                return 1;
            }
        } else {
            if ($other->hasId()) {
                return -1;
            } else {
                return 0;
            }
        }
    }


    /**
     * Est-ce que deux étudiants sont égaux ?
     *
     * @param Student $other L'étudiant à comparer
     * @return bool
     */
    public function isEquals(Student $other) {
        $hasId1 = $this->hasId();
        $hasId2 = $other->hasId();
        if ($hasId1 && $hasId2) {
            if ($this->getId() != $other->getId()) {
                return false;
            }

            return true;
        } else if (!$hasId1 && !$hasId2) {
            if ($this->getFirstName() != $other->getFirstName()) {
                return false;
            }

            if ($this->getLastName() != $other->getLastName()) {
                return false;
            }

            return true;
        } else {
            return false;
        }
    }
}