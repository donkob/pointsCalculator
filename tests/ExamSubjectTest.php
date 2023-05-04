<?php

use PHPUnit\Framework\TestCase;

class ExamSubjectTest extends TestCase{

    protected $examSubject;

    protected function setUp():void{
        $this->examSubject = new ExamSubject("matematika","Közép","30%");
    }

    public function testGetNameFunction (){
        $this->assertEquals("matematika", $this->examSubject->getName());
    }

    public function testConvertPercentStringToInt(){
        $this->assertEquals(30, $this->examSubject->convertExamResultToInt());
    }

    public function testPassedTheExamFunction()
    {
        $this->assertTrue($this->examSubject->passedTheExam());
    }
}