<?php

use PHPUnit\Framework\TestCase;

class MainTest extends TestCase{

    protected $main;

    protected function setUp():void{
        
    }

    public function calculateProvider()
    {
        
        require 'exampleData/homework_input.php';
        return [
            'PASS: 470 (370 + 100)'         
                                    => [$exampleData1, "470 (370 alappont + 100 többletpont)"],
            'PASS: 476 (376 + 100)'         
                                    => [$exampleData2, "476 (376 alappont + 100 többletpont)"],
            'Subject missing'         
                                    => [$exampleData3, "hiba, nem lehetséges a pontszámítás a kötelező érettségi tárgyak hiánya miatt"],
            'Failed an exam'         
                                    => [$exampleData4, "hiba, nem lehetséges a pontszámítás a magyar nyelv és irodalom tárgyból elért 20% alatti eredmény miatt"]
        ];
    }    

    /**
     * @dataProvider calculateProvider
     */    
    public function testCalculate($studentDetails, $output)
    {
        $this->main = new Main($studentDetails);

        $this->assertEquals($this->main->calculate(), $output);
    }   
}