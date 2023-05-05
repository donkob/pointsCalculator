<?php

use PHPUnit\Framework\TestCase;

class StudentTest extends TestCase{

    protected $student;
    protected $universities;

    protected function setUp():void{
        $studentDetails = [
            'valasztott-szak' => [
                'egyetem' => 'ELTE',
                'kar' => 'IK',
                'szak' => 'Programtervező informatikus',
            ],
            'erettsegi-eredmenyek' => [
                [
                    'nev' => 'magyar nyelv és irodalom',
                    'tipus' => 'közép',
                    'eredmeny' => '70%',
                ],
                [
                    'nev' => 'történelem',
                    'tipus' => 'közép',
                    'eredmeny' => '80%',
                ],
                [
                    'nev' => 'matematika',
                    'tipus' => 'emelt',
                    'eredmeny' => '90%',
                ],
                [
                    'nev' => 'angol nyelv',
                    'tipus' => 'közép',
                    'eredmeny' => '94%',
                ],
                [
                    'nev' => 'informatika',
                    'tipus' => 'közép',
                    'eredmeny' => '95%',
                ],
                [
                    'nev' => 'fizika',
                    'tipus' => 'közép',
                    'eredmeny' => '98%',
                ],
            ],
            'tobbletpontok' => [
                [
                    'kategoria' => 'Nyelvvizsga',
                    'tipus' => 'B2',
                    'nyelv' => 'angol',
                ],
                [
                    'kategoria' => 'Nyelvvizsga',
                    'tipus' => 'C1',
                    'nyelv' => 'német',
                ],
            ],
        ];
        $this->student = new Student($studentDetails);

        $eltereq = [
            'mandatory' => [
                'subject' => 'matematika',
                'level' => ''
            ],
            'optional' => ['biológia','fizika','informatika','kémia']
        ];
        $ppkereq = [
            'mandatory' => [
                'subject' => 'angol',
                'level' => 'emelt'
            ],
            'optional' => ['francia','német','olasz','orosz','spanyol','történelem']
        ];
        $this->universities = [new University('ELTE', 'IK', 'Programtervező informatikus', $eltereq), new University('PPKE', 'BTK', 'Anglisztika', $ppkereq)];
    }

    public function testConvertExamResultsToExamSubject (){
        $this->assertInstanceOf("ExamSubject", $this->student->getExamSubjects()[0]);
    }

    public function testIsStudentPassedAllExams(){
        $this->assertTrue($this->student->passedAllTheExam());
    }

    public function testGetFailedExams(){
        $this->assertEquals(null, $this->student->getFailedExam());
    }

    public function testMandatorySubjects(){
        $this->assertTrue($this->student->checkMandaroySubjects());
    }

    public function testMandaroyAndPassedExamLevelChecker(){
        $this->assertTrue($this->student->checkMandatoryAndExamLevel("közép","közép"));
        $this->assertTrue($this->student->checkMandatoryAndExamLevel("közép","emelt"));
    }

    public function testCalculateBasePointsFuncion(){
        $this->assertEquals(376, $this->student->calculateBasePoints($this->universities));
    }

    public function testCalculateLangExamPointsFunction(){
        $this->assertEquals(68, $this->student->getLangExamPoints());
    }

    public function testCalculateAdvancedExamPointsFunction(){
        $this->assertEquals(50, $this->student->getAdvancedExamPoints());
    }

    public function testCalculateAdditionalPointsFunction(){
        $this->assertEquals(100, $this->student->calculateAdditionalPoints());
    }

}