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
}