<?php

/**
 * SUBJECT
 * 
 */

 class Subject 
 {
    /**
     * @var string Name of Subject
     */
    private $name;

    /**
     * @var string Level of Subject
     */
    private $level;

    /**
     * @param string The name and the level of subject. The level is optinal. If we leave blank, it defaults to "közép".
     */
    public function __construct($name, $level="közép"){
        $this->name = $name;
        $this->level = $level;
    }

    /**
     * @return string The subject's name
     */
    public function getName(){
        return $this->name;
    }

    /**
     * @return string The subject's level
     */
    public function getLevel(){
        return $this->level;
    }

 }