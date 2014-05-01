<?php

namespace Infomaniak\Test;

use Infomaniak\People;

class PeopleTest extends \PHPUnit_Framework_TestCase {
    /**
     * @expectedException PHPUnit_Framework_Error
     * @dataProvider providerNotInts
     */
    public function testSetIdWithNonIntValue($value) {
        $object = new People();
        $object->setId($value);
    }


    /**
     * @expectedException PHPUnit_Framework_Error
     * @dataProvider providerNotStrings
     */
    public function testSetFirstNameWithNonStringValue($value) {
        $object = new People();
        $object->setFirstName($value);
    }


    /**
     * @expectedException PHPUnit_Framework_Error
     * @dataProvider providerNotStrings
     */
    public function testSetLastNameWithNonStringValue($value) {
        $object = new People();
        $object->setLastName($value);
    }



    //--------------------------------------------------------------------------
    // Providers
    //--------------------------------------------------------------------------

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