<?php

namespace Infomaniak\Test;

use Infomaniak\Student;

class StudentTest extends \PHPUnit_Framework_TestCase {
    /**
     * @expectedException PHPUnit_Framework_Error
     * @dataProvider providerNotInts
     */
    public function testSetIdWithInvalidValues($value) {
        $student = new Student();

        $student->setId($value);
    }


    public function testSetIdWithValidValues() {
        $student = new Student();

        for ($i = 10; $i >= -10; --$i) {
            $student->setId($i);
            $id = $student->getId();
            $this->assertEquals($i, $id);
            if ($i != 0) {
                $this->assertTrue($student->hasId());
            } else {
                $this->assertFalse($student->hasId());
            }
        }
    }


    /**
     * @expectedException PHPUnit_Framework_Error
     * @dataProvider providerNotStrings
     */
    public function testSetFirstNameWithInvalidValues($value) {
        $student = new Student();

        $student->setFirstName($value);
    }


    /**
     * @dataProvider firstNameProviderValidValues
     */
    public function testSetFirstWithValidValues($expected) {
        $student = new Student();

        $student->setFirstName($expected);
        $value = $student->getFirstName();

        $this->assertEquals($expected, $value);
    }


    /**
     * @expectedException PHPUnit_Framework_Error
     * @dataProvider providerNotStrings
     */
    public function testSetLastNameWithInvalidValues($value) {
        $student = new Student();

        $student->setLastName($value);
    }


    /**
     * @dataProvider lastNameProviderValidValues
     */
    public function testSetLastWithValidValues($expected) {
        $student = new Student();

        $student->setLastName($expected);
        $value = $student->getLastName();

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