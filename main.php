<?php

require 'vendor/autoload.php';

echo "Création d'un campus\n";
$campus = new Infomaniak\Campus();
$campus->setCapacity(3);
$campus->setCity("Montpellier");
$campus->setRegion("Hérault");


echo "Création des étudiants\n";
$studentsToAdd = array();

$student1 = new Infomaniak\Student();
$student1->setId(1);
$student1->setFirstName("Anne");
$student1->setLastName("Isette");
$studentsToAdd[] = $student1;

$student2 = new Infomaniak\Student();
$student2->setId(-1);
$student2->setFirstName("Robin");
$student2->setLastName("Trépide");
$studentsToAdd[] = $student2;

$student3 = new Infomaniak\Student();
$student3->setId(0);
$student3->setFirstName("Paul");
$student3->setLastName("Auchon");
$studentsToAdd[] = $student3;

$student4 = new Infomaniak\Student();
$student4->setId(0);
$student4->setFirstName("Vincent");
$student4->setLastName("Time");
$studentsToAdd[] = $student4;


echo "Ajout des étudiants dans le campus\n";
foreach ($studentsToAdd as $student) {
    try {
        $campus->addStudent($student);
    } catch (Infomaniak\FullCampusException $e) {
        echo "Exception FullCampusException capturée\n";
    }
}


echo "Étudiants dans le campus :\n";
$students1 = $campus->getStudents();
foreach ($students1 as $student) {
    echo sprintf("\t- %s %s (id=%d)\n",
                 $student->getFirstName(),
                 $student->getLastName(),
                 $student->getId());
}


echo "Suppression d'un étudiant du campus\n";
$campus->removeStudent($student1);


echo "Étudiants dans le campus :\n";
$students2 = $campus->getStudents();
foreach ($students2 as $student) {
    echo sprintf("\t- %s %s (id=%d)\n",
                 $student->getFirstName(),
                 $student->getLastName(),
                 $student->getId());
}


echo "Création des professeurs\n";
$teachersToAdd = array();

$teacher1 = new Infomaniak\ExternalTeacher();
$teacher1->setId(1);
$teacher1->setFirstName("Nick");
$teacher1->setLastName("Roipa");
$teacher1->setSalary(1000);
$teachersToAdd[] = $teacher1;

$teacher2 = new Infomaniak\ExternalTeacher();
$teacher2->setId(2);
$teacher2->setFirstName("Gaspard");
$teacher2->setLastName("Alyzan");
$teacher2->setSalary(1500);
$teachersToAdd[] = $teacher2;

$teacher3 = new Infomaniak\InternalTeacher();
$teacher3->setId(3);
$teacher3->setFirstName("Pacôme");
$teacher3->setLastName("Dabitude");
$teacher3->setSalary(2000);
$teachersToAdd[] = $teacher3;

$teacher4 = new Infomaniak\InternalTeacher();
$teacher4->setId(4);
$teacher4->setFirstName("Harry");
$teacher4->setLastName("Vancouvan");
$teacher4->setSalary(2500);
$teachersToAdd[] = $teacher4;


echo "Ajout des professeurs dans le campus\n";
foreach ($teachersToAdd as $teacher) {
    $campus->addTeacher($teacher);
}


echo "Professeurs dans le campus :\n";
$teachers1 = $campus->getTeachers();
foreach ($teachers1 as $teacher) {
    echo sprintf("\t- %s %s (id=%d, salary=%d)\n",
                 $teacher->getFirstName(),
                 $teacher->getLastName(),
                 $teacher->getId(),
                 $teacher->getSalary());
}


echo "Suppression d'un professeur\n";
$campus->removeTeacher($teacher1);


echo "Professeurs dans le campus :\n";
$teachers2 = $campus->getTeachers();
foreach ($teachers2 as $teacher) {
    echo sprintf("\t- %s %s (id=%d, salary=%d)\n",
                 $teacher->getFirstName(),
                 $teacher->getLastName(),
                 $teacher->getId(),
                 $teacher->getSalary());
}