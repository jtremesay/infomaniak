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
            throw new \InvalidArgumentException('setId expected Argument $id to be int');
        }

        $this->_id = $id;
    }


    /**
     * Récupère le prénom
     *
     * @return string Le prénom
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
            throw new \InvalidArgumentException('setFirstName expected Argument $firstName to be string');
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
            throw new \InvalidArgumentException('setLastName expected Argument $lastName to be string');
        }

        $this->_lastName = $lastName;
    }



    //--------------------------------------------------------------------------
    // JsonSerializable
    //--------------------------------------------------------------------------
    public function jsonSerialize() {
        $data = [];
        $data['id'] = $this->getId();
        $data['firstname'] = $this->getFirstName();
        $data['lastname'] = $this->getLastName();

        return $data;
    }
}