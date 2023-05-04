<?php

/**
 * EXAMSUBJECT extends SUBJECT
 * As same as SUBJECT but expanding 1 new property and few methods
 */

 class ExamSubject extends Subject
 {
    /**
     * @var string Result of Exam
     */
    private $examResult;

    /**
     * @param string The name and the level of subject. The level is optinal. If we leave blank, it defaults to "közép".
     */
    public function __construct($name, $level, $examResult){
        parent::__construct($name, $level);
        $this->examResult = $examResult;
    }

    /**
     * @return string The examresult
     */
    public function getExamResult(){
        return $this->examResult;
    }

    /**
     * @return int Convert string exemresult to int
     */
    public function convertExamResultToInt(){
        return (int) str_replace('%', '', $this->examResult);
    }

    /**
     * @return bool Is examresult under 20%?
     */
    public function passedTheExam()
    {
        return $this->convertExamResultToInt() >= 20;
    }

 }