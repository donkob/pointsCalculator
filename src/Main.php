<?php

/**
 * MAIN
 * 
 */

 class Main 
 {
    /**
     * @var array Student Details
     */
    private $studentDetails;

    /**
     * @var array University List
     */
    private $universities;

    /**
     * @param string The name and the level of subject. The level is optinal. If we leave blank, it defaults to "közép".
     */
    public function __construct($studentDetails){
        $this->studentDetails = $studentDetails;
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

    /**
     * @return String
     */
    public function calculate(){
        $student = new Student($this->studentDetails);
        //Check All Exam Pass
        if(!$student->passedAllTheExam()){
            return "hiba, nem lehetséges a pontszámítás a " . $student->getFailedExam() . " tárgyból elért 20% alatti eredmény miatt";
            exit();
        }

        //Check All Mandaroty Subject
        if(!$student->checkMandaroySubjects()){
            return "hiba, nem lehetséges a pontszámítás a kötelező érettségi tárgyak hiánya miatt";
            exit();
        }

        //Calculate
        $basePoints = $student->calculateBasePoints($this->universities);
        $additionalPoints = $student->calculateAdditionalPoints();
        return $basePoints+$additionalPoints . " (" . $basePoints . " alappont + " . $additionalPoints . " többletpont)";
    }
 }