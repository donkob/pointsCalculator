<?php

/**
 * UNIVERSITY
 * 
 */

 class University 
 {
    /**
     * @var string Name of University
     */
    private $name;

    /**
     * @var string Faculty of University
     */
    private $faculty;

    /**
     * @var string Course of University
     */
    private $course;

    /**
     * @var array Requirements of University
     */
    private $requirements;

    /**
     * @param string The name and the level of subject. The level is optinal. If we leave blank, it defaults to "közép".
     */
    public function __construct($name, $faculty, $course, $requirements){
        $this->name = $name;
        $this->faculty = $faculty;
        $this->course = $course;
        $optionalArr = [];
        foreach($requirements['optional'] as $optional){
            array_push($optionalArr, new Subject($optional));
        }
        $this->requirements = [
            'mandatory' => new Subject($requirements['mandatory']['subject'],$requirements['mandatory']['level']),
            'optional' => $optionalArr];
    }

    /**
     * @return string The University's name
     */
    public function getName(){
        return $this->name;
    }

    /**
     * @return string The University's faculty
     */
    public function getFaculty(){
        return $this->faculty;
    }

    /**
     * @return string The University's course
     */
    public function getCourse(){
        return $this->course;
    }

    /**
     * @return array The requirements array
     */
    public function getRequirements(){
        return $this->requirements;
    }

 }