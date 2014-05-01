<?php

namespace Infomaniak\Test;

use Infomaniak\ExternalTeacher;

class ExternalTeacherTest extends \PHPUnit_Framework_TestCase {
    /**
     * @expectedException PHPUnit_Framework_Error
     * @dataProvider providerNotInts
     */
    public function testSetSalaryWithNonIntValue($value) {
        $object = new ExternalTeacher();
        $object->setSalary($value);
    }



    //--------------------------------------------------------------------------
    // Providers
    //--------------------------------------------------------------------------

    /**
     * Des machins qui ne sont pas des entiers
     */
    public function providerNotInts() {
        return Helpers::providerNotInts();
    }
}