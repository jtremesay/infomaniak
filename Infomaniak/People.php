<?php

namespace Infomaniak;


/**
 * Une personne
 *
 * Une personne possède un nom, un prénom et un identifiant
 */
class People  implements \JsonSerializable {
    protected $_id = 0;
    protected $_firstName = "";
    protected $_lastName = "";


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
     * @param int $id L'identifiant
     */
    public function setId($id) {
        if (!is_int($id)) {
            trigger_error('setId expected Argument $id to be int', E_USER_WARNING);
        }

        $this->_id = $id;
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

        $this->_lastName = $lastName;
    }



    //--------------------------------------------------------------------------
    // JsonSerializable
    //--------------------------------------------------------------------------
    public function jsonSerialize() {
        $data = array();
        $data['id'] = $this->getId();
        $data['firstname'] = $this->getFirstName();
        $data['lastname'] = $this->getLastName();

        return $data;
    }
}