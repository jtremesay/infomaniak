<?php

namespace Infomaniak\Test;

use Infomaniak\ExternalTeacher;

class ExternalTeacherTest extends \PHPUnit_Framework_TestCase {
    /**
     * @expectedException \InvalidArgumentException
     * @dataProvider providerNotInts
     */
    public function testSetSalaryWithNonIntValue($value) {
        $object = new ExternalTeacher();
        $object->setSalary($value);
    }


    /**
     * @dataProvider providerForTestJsonSerialize
     */
    public function testJsonSerialize($id, $firstname, $lastname, $salary, $expected) {
        $teacher = new ExternalTeacher();
        $teacher->setId($id);
        $teacher->setFirstName($firstname);
        $teacher->setLastName($lastname);
        $teacher->setSalary($salary);

        $json = json_encode($teacher);
        $this->assertEquals($expected, $json);
    }


    public function providerForTestJsonSerialize() {
        return array(
            array(0, 'Paul', 'Auchon', 5000, '{"id":0,"firstname":"Paul","lastname":"Auchon","salary":5000,"type":"external"}'),
        );
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