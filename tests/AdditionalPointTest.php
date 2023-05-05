<?php

use PHPUnit\Framework\TestCase;

class AdditionalPointTest extends TestCase{

    protected $additionalPoint;

    protected function setUp():void{
        $this->additionalPoint = new AdditionalPoint("Nyelvvizsga","B2","angol");
    }

    public function testGetCategoryFunction (){
        $this->assertEquals("Nyelvvizsga", $this->additionalPoint->getCategory());
    }

    public function testGetTypeFunction (){
        $this->assertEquals("B2", $this->additionalPoint->getType());
    }
    
    public function testGetLangFunction (){
        $this->assertEquals("angol", $this->additionalPoint->getLang());
    }

}