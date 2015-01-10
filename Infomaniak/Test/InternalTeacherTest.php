<?php

namespace Infomaniak\Test;

use Infomaniak\InternalTeacher;

class InternalTeacherTest extends \PHPUnit_Framework_TestCase {
    /**
     * @expectedException \InvalidArgumentException
     * @dataProvider providerNotInts
     */
    public function testSetSalaryWithNonIntValue($value) {
        $object = new InternalTeacher();
        $object->setSalary($value);
    }


    public function testSetSalary() {
        $salary = 5000;

        $object1 = new InternalTeacher();
        $object2 = new InternalTeacher();

        // Assigne un nouveau salaire au premier prof
        $object1->setSalary($salary);
        $this->assertEquals($salary, $object1->getSalary());

        // Vérifie que le salaire s'est propagé au deuxième prof
        $this->assertEquals($salary, $object2->getSalary());

        // Vérifie que le salaire s'est propagé au troisième prof
        $object3 = new InternalTeacher();
        $this->assertEquals($salary, $object3->getSalary());
    }


    /**
     * @dataProvider providerForTestJsonSerialize
     */
    public function testJsonSerialize($id, $firstname, $lastname, $salary, $expected) {
        $teacher = new InternalTeacher();
        $teacher->setId($id);
        $teacher->setFirstName($firstname);
        $teacher->setLastName($lastname);
        $teacher->setSalary($salary);

        $json = json_encode($teacher);
        $this->assertEquals($expected, $json);
    }


    public function providerForTestJsonSerialize() {
        return [
            [0, 'Paul', 'Auchon', 5000, '{"id":0,"firstname":"Paul","lastname":"Auchon","salary":5000,"type":"internal"}'],
        ];
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