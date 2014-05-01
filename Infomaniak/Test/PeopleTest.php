<?php

namespace Infomaniak\Test;

use Infomaniak\People;

class PeopleTest extends \PHPUnit_Framework_TestCase {
    /**
     * @expectedException PHPUnit_Framework_Error
     * @dataProvider providerNotInts
     */
    public function testSetIdWithInvalidValues($value) {
        $people = new People();

        $people->setId($value);
    }


    public function testSetIdWithValidValues() {
        $people = new People();

        for ($i = 10; $i >= -10; --$i) {
            $people->setId($i);
            $id = $people->getId();
            $this->assertEquals($i, $id);

            // TODO : à migrer dans le test d'étudiant
            /*
            if ($i != 0) {
                $this->assertTrue($student->hasId());
            } else {
                $this->assertFalse($student->hasId());
            }
            */
        }
    }


    /**
     * @expectedException PHPUnit_Framework_Error
     * @dataProvider providerNotStrings
     */
    public function testSetFirstNameWithInvalidValues($value) {
        $people = new People();

        $people->setFirstName($value);
    }


    /**
     * @dataProvider firstNameProviderValidValues
     */
    public function testSetFirstWithValidValues($expected) {
        $people = new People();

        $people->setFirstName($expected);
        $value = $people->getFirstName();

        $this->assertEquals($expected, $value);
    }


    /**
     * @expectedException PHPUnit_Framework_Error
     * @dataProvider providerNotStrings
     */
    public function testSetLastNameWithInvalidValues($value) {
        $people = new People();

        $people->setLastName($value);
    }


    /**
     * @dataProvider lastNameProviderValidValues
     */
    public function testSetLastNameWithValidValues($expected) {
        $people = new People();

        $people->setLastName($expected);
        $value = $people->getLastName();

        $this->assertEquals($expected, $value);
    }




    //--------------------------------------------------------------------------
    // Providers
    //--------------------------------------------------------------------------


    /**
     * Des prénoms corrects
     */
    public function firstNameProviderValidValues() {
        return array(
            array(""),          // Vide
            array("Pierre"),    // Test basique
            array("Gaëtan"),    // Accents
            array("Влади́мир"), // Cyrillique (Vladimir)
            array("秀吉"),       // Kanji (Hideyoshi)
        );
    }


    /**
     * Des noms corrects
     */
    public function lastNameProviderValidValues() {
        return array(
            array(""),         // Vide
            array("Tramo"),    // Test basique
            array("Bouriné"),  // Accents
            array("Улья́нов"), // Cyrillique (Lénine)
            array("木下"),      // Kanji (Kinoshita)
        );
    }


    /**
     * Des machins qui ne sont pas des strings
     */
    public function providerNotStrings() {
        return Helpers::providerNotStrings();
    }


    /**
     * Des machins qui ne sont pas des entiers
     */
    public function providerNotInts() {
        return Helpers::providerNotInts();
    }
}