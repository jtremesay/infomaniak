<?php

namespace Infomaniak\Test;

use Infomaniak\Student;

class StudentTest extends \PHPUnit_Framework_TestCase {
    public function testSetIdWithValidValues() {
        $student = new Student();

        for ($i = 10; $i >= -10; --$i) {
            $student->setId($i);
            if ($i != 0) {
                $this->assertTrue($student->hasId());
            } else {
                $this->assertFalse($student->hasId());
            }
        }
    }
}