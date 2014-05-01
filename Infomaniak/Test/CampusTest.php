<?php

namespace Infomaniak\Test;

use Infomaniak\Campus;

class CampusTest extends \PHPUnit_Framework_TestCase {
    /**
     * @expectedException PHPUnit_Framework_Error
     * @dataProvider providerNotStrings
     */
    public function testSetCityWithNonStringValue($value) {
        $object = new Campus();
        $object->setCity($value);
    }


    /**
     * @expectedException PHPUnit_Framework_Error
     * @dataProvider providerNotStrings
     */
    public function testSetRegionWithNonStringValue($value) {
        $campus = new Campus();
        $campus->setRegion($value);
    }


    /**
     * @expectedException PHPUnit_Framework_Error
     * @dataProvider providerNotInts
     */
    public function testSetCapacityWithNonIntValue($value) {
        $object = new Campus();
        $object->setCapacity($value);
    }


    public function testSetCapacity() {
        $campus = new Campus();

        for ($i = 10; $i >= -10; --$i) {
            $campus->setCapacity($i);
            $capacity = $campus->getCapacity();
            if ($i > 0) {
                $this->assertEquals($i, $capacity);
            } else {
                $this->assertEquals(0, $capacity);
            }
        }
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