<?php

namespace Infomaniak\Test;

use Infomaniak\Campus;
use Infomaniak\Student;
use Infomaniak\FullCampusException;

class CampusTest extends \PHPUnit_Framework_TestCase {
    public function testGetCity() {
        $expected = "Montpellier";

        $campus = new Campus();
        $campus->setCity($expected);
        $value = $campus->getCity();

        $this->assertEquals($expected, $value);
    }


    /**
     * @expectedException PHPUnit_Framework_Error
     * @dataProvider providerNotStrings
     */
    public function testSetCityWithNonStringValue($value) {
        $campus = new Campus();
        $campus->setCity($value);
    }


    public function testGetRegion() {
        $expected = "Hérault";

        $campus = new Campus();
        $campus->setRegion($expected);
        $value = $campus->getRegion();

        $this->assertEquals($expected, $value);
    }


    /**
     * @expectedException PHPUnit_Framework_Error
     * @dataProvider providerNotStrings
     */
    public function testSetRegionWithNonStringValue($value) {
        $campus = new Campus();
        $campus->setRegion($value);
    }


    public function testGetCapacity() {
        $expected = 10;

        $campus = new Campus();
        $campus->setCapacity($expected);
        $value = $campus->getCapacity();

        $this->assertEquals($expected, $value);
    }


    /**
     * @expectedException PHPUnit_Framework_Error
     * @dataProvider providerNotInts
     */
    public function testSetCapacityWithNonIntValue($value) {
        $campus = new Campus();
        $campus->setCapacity($value);
    }


    /**
     * @expectedException InvalidArgumentException
     */
    public function testSetCapacityWithNegativeValue () {
        $campus = new Campus();
        $campus->setCapacity(-10);
    }


    public function testSetCapacityToSmallestCapacityThanCurrentCount() {
        $student1 = new Student();
        $student1->setFirstName("Anne");
        $student1->setLastName("Isette");

        $student2 = new Student();
        $student2->setFirstName("Paul");
        $student2->setLastName("Auchon");

        $campus = new Campus();
        $campus->setCapacity(10);
        $campus->addStudent($student1);
        $campus->addStudent($student2);
        $campus->setCapacity(1);

        $this->assertEquals(1, $campus->count());
    }


    public function testAddStudent() {
        $student = new Student();
        $student->setFirstName("Anne");
        $student->setLastName("Isette");

        $campus = new Campus();
        $campus->setCapacity(10);
        $campus->addStudent($student);

        $this->assertEquals(1, $campus->count());
    }


    /**
     * @expectedException Infomaniak\FullCampusException
     */
    public function testAddStudenToFullCampus() {
        $student1 = new Student();
        $student1->setFirstName("Anne");
        $student1->setLastName("Isette");

        $student2 = new Student();
        $student2->setFirstName("Paul");
        $student2->setLastName("Auchon");

        $campus = new Campus();
        $campus->setCapacity(1);
        $campus->addStudent($student1);
        $campus->addStudent($student2);
    }


    public function testContainsStudentSearchByRef() {
        $student = new Student();
        $student->setFirstName("Anne");
        $student->setLastName("Isette");

        $campus = new Campus();
        $campus->setCapacity(1);
        $campus->addStudent($student);


        $this->assertTrue($campus->containsStudent($student));
    }


    public function testContainsStudentSearchByValue() {
        $student1 = new Student();
        $student1->setFirstName("Anne");
        $student1->setLastName("Isette");

        $student2 = new Student();
        $student2->setFirstName("Anne");
        $student2->setLastName("Isette");

        $campus = new Campus();
        $campus->setCapacity(1);
        $campus->addStudent($student1);


        $this->assertTrue($campus->containsStudent($student2));
    }


    public function testContainsStudentNotContain() {
        $student1 = new Student();
        $student1->setFirstName("Anne");
        $student1->setLastName("Isette");

        $student2 = new Student();
        $student2->setFirstName("Paul");
        $student2->setLastName("Auchon");

        $campus = new Campus();
        $campus->setCapacity(1);
        $campus->addStudent($student1);

        $this->assertFalse($campus->containsStudent($student2));
    }


    public function testRemoveStudentWhoExits() {
        $student = new Student();
        $student->setFirstName("Anne");
        $student->setLastName("Isette");

        $campus = new Campus();
        $campus->setCapacity(1);
        $campus->addStudent($student);
        $campus->removeStudent($student);

        $this->assertEquals(0, $campus->count());
    }


    public function testRemoveStudentWhoDoesntExits() {
        $student1 = new Student();
        $student1->setFirstName("Anne");
        $student1->setLastName("Isette");

        $student2 = new Student();
        $student2->setFirstName("Paul");
        $student2->setLastName("Auchon");

        $campus = new Campus();
        $campus->setCapacity(1);
        $campus->addStudent($student1);
        $campus->removeStudent($student2);

        $this->assertEquals(1, $campus->count());
    }


    public function testGetStudents() {
        $student1 = new Student();
        $student1->setFirstName("Anne");
        $student1->setLastName("Isette");

        $student2 = new Student();
        $student2->setFirstName("Paul");
        $student2->setLastName("Auchon");

        $campus = new Campus();
        $campus->setCapacity(10);
        $campus->addStudent($student1);
        $campus->addStudent($student2);

        $students = $campus->getStudents();
        $this->assertCount($campus->count(), $students);
    }


    public function testGetStudentsModifingStudent() {
        $student = new Student();
        $student->setFirstName("Anne");
        $student->setLastName("Isette");

        $campus = new Campus();
        $campus->setCapacity(10);
        $campus->addStudent($student);

        $students = $campus->getStudents();
        $studentClone = $students[0];
        $studentClone->setFirstName("Sophie");
        $this->assertNotEquals($student, $studentClone);
    }


    public function testGetStudentsModifingStudents() {
        $student = new Student();
        $student->setFirstName("Anne");
        $student->setLastName("Isette");

        $campus = new Campus();
        $campus->setCapacity(10);
        $campus->addStudent($student);

        $students = $campus->getStudents();
        unset($students[0]);

        $this->assertEquals(1, $campus->count());
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