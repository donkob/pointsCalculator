<?php

use PHPUnit\Framework\TestCase;

class SubjectTest extends TestCase{

    private $subject;

    public function testGetNameFunction (){
        $this->subject = new Subject("matematika");
        $this->assertEquals("matematika", $this->subject->getName());
    }

    public function testSubjectCretionWithoutDefineLevel(){
        $this->subject = new Subject("matematika");
        $this->assertEquals("közép", $this->subject->getLevel());
    }

    
    public function testSubjectCretionWithLevel(){
        $this->subject = new Subject("matematika", "emelt");
        $this->assertEquals("emelt", $this->subject->getLevel());
    }

}