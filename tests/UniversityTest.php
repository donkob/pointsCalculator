<?php

use PHPUnit\Framework\TestCase;

class UniversityTest extends TestCase{

    protected $university;

    protected function setUp():void{
        $requirements = [
            'mandatory' => [
                'subject' => 'matematika',
                'level' => ''
            ],
            'optional' => ['biológia','fizika','informatika','kémia']
        ];
        $this->university = new University('ELTE', 'IK', 'Programtervező informatikus',$requirements);
    }

    public function testConvertRequirementsToSubject (){
        $this->assertInstanceOf("Subject", $this->university->getRequirements()['mandatory']);
        $this->assertInstanceOf("Subject", $this->university->getRequirements()['optional'][0]);
        $this->assertEquals("biológia", $this->university->getRequirements()['optional'][0]->getName());
        $this->assertEquals("közép", $this->university->getRequirements()['mandatory']->getLevel());
    }

}