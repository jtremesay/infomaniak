<?php

namespace Infomaniak\Test;

use Infomaniak\People;

class PeopleTest extends \PHPUnit_Framework_TestCase {
    /**
     * @expectedException \InvalidArgumentException
     * @dataProvider providerNotInts
     */
    public function testSetIdWithNonIntValue($value) {
        $object = new People();
        $object->setId($value);
    }


    /**
     * @expectedException \InvalidArgumentException
     * @dataProvider providerNotStrings
     */
    public function testSetFirstNameWithNonStringValue($value) {
        $object = new People();
        $object->setFirstName($value);
    }


    /**
     * @expectedException \InvalidArgumentException
     * @dataProvider providerNotStrings
     */
    public function testSetLastNameWithNonStringValue($value) {
        $object = new People();
        $object->setLastName($value);
    }


    /**
     * @dataProvider providerForTestJsonSerialize
     */
    public function testJsonSerialize(People $people, $expected) {
        $json = json_encode($people);
        $this->assertEquals($expected, $json);
    }


    public function providerForTestJsonSerialize() {
        $data = array();

        $people = new People();
        $people->setId(4);
        $people->setFirstName("Harry");
        $people->setLastName("Vancouvan");
        $data[] = array(
            $people,
            '{"id":4,"firstname":"Harry","lastname":"Vancouvan"}'
        );

        return $data;
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