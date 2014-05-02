<?php

namespace Infomaniak\Test;

use Infomaniak\Student;

class StudentTest extends \PHPUnit_Framework_TestCase {
    public function testSetId() {
        $object = new Student();
        for ($id = 10; $id >= -10; --$id) {
            $object->setId($id);
            if ($id != 0) {
                $this->assertTrue($object->hasId());
            } else {
                $this->assertFalse($object->hasId());
            }
        }
    }


    /**
     * @dataProvider providerForIsEquals
     */
    public function testIsEquals($id1, $firstname1, $lastname1, $id2, $firstname2, $lastname2, $expected) {
        $student1 = new Student();
        $student1->setId($id1);
        $student1->setFirstName($firstname1);
        $student1->setLastName($lastname1);

        $student2 = new Student();
        $student2->setId($id2);
        $student2->setFirstName($firstname2);
        $student2->setLastName($lastname2);

        $this->assertEquals($expected, $student1->isEquals($student2));
    }


    public function providerForIsEquals() {
        return array(
            array(10, "Anne", "Isette", 11, "Paul", "Auchon", false),
            array(10, "Anne", "Isette", 10, "Anne", "Isette", true),
            array(0, "Anne", "Isette", 0, "Paul", "Auchon", false),
            array(0, "Anne", "Isette", 0, "Anne", "Auchon", false),
            array(0, "Anne", "Isette", 0, "Anne", "Isette", true),
            array(10, "Anne", "Isette", 0, "Paul", "Auchon", false),
        );
    }


    /**
     * @dataProvider providerForTestJsonSerialize
     */
    public function testJsonSerialize($id, $firstname, $lastname, $expected) {
        $student = new Student();
        $student->setId($id);
        $student->setFirstName($firstname);
        $student->setLastName($lastname);

        $json = json_encode($student);
        $this->assertEquals($expected, $json);
    }


    public function providerForTestJsonSerialize() {
        return array(
            array(0, 'Paul', 'Auchon', '{"id":0,"firstname":"Paul","lastname":"Auchon","has_id":false}'),
            array(1, 'Anne', 'Isette', '{"id":1,"firstname":"Anne","lastname":"Isette","has_id":true}'),
        );
    }
}