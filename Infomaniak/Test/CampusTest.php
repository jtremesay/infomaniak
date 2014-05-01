<?php

namespace Infomaniak\Test;

use Infomaniak\Campus;
use Infomaniak\InternalTeacher;
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

        $this->assertEquals(1, $campus->countStudents());
    }


    public function testAddStudent() {
        $student = new Student();
        $student->setFirstName("Anne");
        $student->setLastName("Isette");

        $campus = new Campus();
        $campus->setCapacity(10);
        $campus->addStudent($student);

        $this->assertEquals(1, $campus->countStudents());
    }


    public function testAddStudentAlreadyAddedStudent() {
        $student = new Student();
        $student->setFirstName("Anne");
        $student->setLastName("Isette");

        $campus = new Campus();
        $campus->setCapacity(10);
        $campus->addStudent($student);
        $campus->addStudent($student);

        $this->assertEquals(1, $campus->countStudents());
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


    public function testStudentExists() {
        $student = new Student();
        $student->setFirstName("Anne");
        $student->setLastName("Isette");

        $campus = new Campus();
        $campus->setCapacity(1);
        $campus->addStudent($student);


        $this->assertTrue($campus->studentsExists($student));
    }



    public function testStudentExistsNotContain() {
        $student1 = new Student();
        $student1->setFirstName("Anne");
        $student1->setLastName("Isette");

        $student2 = new Student();
        $student2->setFirstName("Paul");
        $student2->setLastName("Auchon");

        $campus = new Campus();
        $campus->setCapacity(1);
        $campus->addStudent($student1);

        $this->assertFalse($campus->studentsExists($student2));
    }


    public function testRemoveStudentWhoExits() {
        $student = new Student();
        $student->setFirstName("Anne");
        $student->setLastName("Isette");

        $campus = new Campus();
        $campus->setCapacity(1);
        $campus->addStudent($student);
        $campus->removeStudent($student);

        $this->assertEquals(0, $campus->countStudents());
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

        $this->assertEquals(1, $campus->countStudents());
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
        $this->assertCount($campus->countStudents(), $students);
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

        $this->assertEquals(1, $campus->countStudents());
    }


    public function testGetStudentsSorted() {
        $student1 = new Student();
        $student1->setId(1);
        $student1->setFirstName("Anne");
        $student1->setLastName("Isette");

        $student2 = new Student();
        $student2->setId(0);
        $student2->setFirstName("Paul");
        $student2->setLastName("Auchon");

        $student3 = new Student();
        $student3->setId(-1);
        $student3->setFirstName("Vincent");
        $student3->setLastName("Time");

        $campus = new Campus();
        $campus->setCapacity(10);
        $campus->addStudent($student1);
        $campus->addStudent($student2);
        $campus->addStudent($student3);

        $students = $campus->getStudents();
        $this->assertEquals(0, $students[0]->getId());
        $this->assertEquals(-1, $students[1]->getId());
        $this->assertEquals(1, $students[2]->getId());
    }


    public function testAddTeacher() {
        $teacher = new InternalTeacher();
        $teacher->setFirstName("Anne");
        $teacher->setLastName("Isette");

        $campus = new Campus();
        $campus->setCapacity(10);
        $campus->addTeacher($teacher);

        $this->assertEquals(1, $campus->countTeachers());
    }


    public function testAddTeacherAlreadyAddedTeacher() {
        $teacher = new InternalTeacher();
        $teacher->setFirstName("Anne");
        $teacher->setLastName("Isette");

        $campus = new Campus();
        $campus->setCapacity(10);
        $campus->addTeacher($teacher);
        $campus->addTeacher($teacher);

        $this->assertEquals(1, $campus->countTeachers());
    }


    public function testRemoveTeacherWhoExists() {
        $teacher = new InternalTeacher();
        $teacher->setFirstName("Anne");
        $teacher->setLastName("Isette");

        $campus = new Campus();
        $campus->setCapacity(10);
        $campus->addTeacher($teacher);
        $campus->removeTeacher($teacher);

        $this->assertEquals(0, $campus->countTeachers());
    }


    public function testRemoveTeacherWhoDoesntExists() {
        $teacher1 = new InternalTeacher();
        $teacher1->setFirstName("Anne");
        $teacher1->setLastName("Isette");

        $teacher2 = new InternalTeacher();
        $teacher2->setFirstName("Paul");
        $teacher2->setLastName("Auchon");

        $campus = new Campus();
        $campus->setCapacity(10);
        $campus->addTeacher($teacher1);
        $campus->removeTeacher($teacher2);

        $this->assertEquals(1, $campus->countTeachers());
    }


    public function testTeacherExistsWhoExists() {
        $teacher = new InternalTeacher();
        $teacher->setFirstName("Anne");
        $teacher->setLastName("Isette");

        $campus = new Campus();
        $campus->setCapacity(10);
        $campus->addTeacher($teacher);

        $this->assertTrue($campus->teacherExists($teacher));
    }


    public function testTeacherExistsWhoDoesntExists() {
        $teacher1 = new InternalTeacher();
        $teacher1->setFirstName("Anne");
        $teacher1->setLastName("Isette");

        $teacher2 = new InternalTeacher();
        $teacher2->setFirstName("Paul");
        $teacher2->setLastName("Auchon");

        $campus = new Campus();
        $campus->setCapacity(10);
        $campus->addTeacher($teacher1);

        $this->assertFalse($campus->teacherExists($teacher2));
    }


    public function testGetTeachers() {
        $teacher1 = new InternalTeacher();
        $teacher1->setFirstName("Anne");
        $teacher1->setLastName("Isette");

        $teacher2 = new InternalTeacher();
        $teacher2->setFirstName("Paul");
        $teacher2->setLastName("Auchon");

        $campus = new Campus();
        $campus->setCapacity(10);
        $campus->addTeacher($teacher1);
        $campus->addTeacher($teacher2);

        $teachers = $campus->getTeachers();
        $this->assertCount($campus->countTeachers(), $teachers);
    }


    public function testGetTeachersModifingTeacher() {
        $teacher = new InternalTeacher();
        $teacher->setFirstName("Anne");
        $teacher->setLastName("Isette");

        $campus = new Campus();
        $campus->setCapacity(10);
        $campus->addTeacher($teacher);

        $teachers = $campus->getTeachers();
        $teacherClone = $teachers[0];
        $teacherClone->setFirstName("Sophie");
        $this->assertNotEquals($teacher, $teacherClone);
    }


    public function testGetTeachersModifingTeachers() {
        $teacher = new InternalTeacher();
        $teacher->setFirstName("Anne");
        $teacher->setLastName("Isette");

        $campus = new Campus();
        $campus->setCapacity(10);
        $campus->addTeacher($teacher);

        $teachers = $campus->getTeachers();
        unset($teachers[0]);

        $this->assertEquals(1, $campus->countTeachers());
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