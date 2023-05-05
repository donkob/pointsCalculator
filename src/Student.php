<?php

/**
 * STUDENT
 * 
 */

 class Student 
 {
    /**
     * @var array Chosen university
     */
    private $university;

    /**
     * @var array Student's exam results
     */
    private $examResults;

    /**
     * @var array Student's additionalPoints
     */
    private $additionalPoints;

    /**
     * @param string The name and the level of subject. The level is optinal. If we leave blank, it defaults to "közép".
     */
    public function __construct($studentDetails){
        $examResultsArr = [];
        foreach($studentDetails['erettsegi-eredmenyek'] as $examResult){
            array_push($examResultsArr, new ExamSubject($examResult['nev'], $examResult['tipus'], $examResult['eredmeny']));
        }
        $this->examResults = $examResultsArr;

        $this->university = [
            'egyetem' => $studentDetails['valasztott-szak']['egyetem'],
            'kar' => $studentDetails['valasztott-szak']['kar'],
            'szak' => $studentDetails['valasztott-szak']['szak']
        ];

        $additionalPointsArr = [];
        foreach($studentDetails['tobbletpontok'] as $additionalPoint){
            array_push($additionalPointsArr, new AdditionalPoint($additionalPoint['kategoria'], $additionalPoint['tipus'], $additionalPoint['nyelv']));
        }
        $this->additionalPoints = $additionalPointsArr;
    }

    /**
     * @return string The Student's exam results
     */
    public function getExamSubjects(){
        return $this->examResults;
    }

    /**
     * @return bool If student passed all exam return true else false
     */
    public function passedAllTheExam(){
        foreach($this->examResults as $examResult){
            if(!$examResult->passedTheExam()){
                return false;
            }
        }
        return true;
    }

    /**
     * @return bool Get the failed exam
     */
    public function getFailedExam(){
        foreach($this->examResults as $examResult){
            if(!$examResult->passedTheExam()){
                return $examResult->getName();
            }
        }
    }

    /**
     * @return bool Check all mandatory subject
     */
    public function checkMandaroySubjects(){
        $mandaroySubjects = ["magyar nyelv és irodalom", "történelem", "matematika"];
        foreach($this->examResults as $examResult){
            if (in_array($examResult->getName(), $mandaroySubjects)){
                unset($mandaroySubjects[array_search($examResult->getName(), $mandaroySubjects)]);
            }
        }
        return count($mandaroySubjects) == 0;
    }

    /**
     * @return bool Check is mandaroy and exam level
     */
    public function checkMandatoryAndExamLevel($mandatory, $exam){
        if($mandatory == "közép" && $exam == "közép"){
            return true;
        }elseif ($mandatory == "közép" && $exam == "emelt"){
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return int Calculate Base Points
     */
    public function calculateBasePoints($universities){
        $requirements = [];
        $optinals = [];
        $point = 0;
        foreach($universities as $usity){
            if($usity->getName() == $this->university['egyetem'] && 
            $usity->getFaculty() == $this->university['kar'] && 
            $usity->getCourse() == $this->university['szak']){
                $requirements = $usity->getRequirements();
            }
        }

        foreach ($this->examResults as $examResult){
            
            if($examResult->getName() == $requirements['mandatory']->getName() && 
            $this->checkMandatoryAndExamLevel($requirements['mandatory']->getLevel(), $examResult->getLevel())){
                $point += $examResult->convertExamResultToInt();
            }
            
            foreach($requirements['optional'] as $require){
                if($examResult->getName() == $require->getName()){
                    array_push($optinals,$examResult->convertExamResultToInt());
                }
            }
        }

        if(count($optinals) > 0){
            $point += max($optinals);
        }

        return $point*2;
    }

    /**
     * @return int Calculate Language Exam points
     */
    public function getLangExamPoints(){
        $pointsArr = [];
        $maxValues = ['B2' => 28, 'C1' => 40];
        $point = 0;
        foreach($this->additionalPoints as $additionalPoint){
            $lang = $additionalPoint->getLang();
            $type = $additionalPoint->getType();
            $value = $maxValues[$type];
            if(isset($pointsArr[$lang])){
                $currType = $pointsArr[$lang]['type'];
                if($type == 'C1' && $currType == 'B2'){
                    $pointsArr[$lang] = [
                        'type' => 'C1'
                    ];
                    $point += 12;
                }
            } else {
                $pointsArr[$lang] = [
                    'type' => $type
                ];
                $point += $value;
            }
        }
        return $point;
    }

    /**
     * $return int Calculate Advanced Exam Points
     */
    public function getAdvancedExamPoints(){
        $point = 0;
        foreach ($this->examResults as $examResult){
            if($examResult->getLevel() == 'emelt'){
                $point += 50;
            }
        }
        return $point;

    }

    /**
     * @return int Calculate Additional Points
     */
    public function calculateAdditionalPoints(){
        $point = 0;
        $point += $this->getLangExamPoints();
        $point += $this->getAdvancedExamPoints();

        return $point >= 100 ? 100 : $point;
    }

 }