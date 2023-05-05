<?php

/**
 * ADDITIONAL POINT
 * 
 */

 class AdditionalPoint 
 {
    /**
     * @var string Additional Point category eg. Nyelvvizsga 
     */
    private $category;

    /**
     * @var string Additional Point type 
     */
    private $type;
    
    /**
     * @var string Additional Point language
     */
    private $lang;

    public function __construct($category, $type, $lang){
        $this->category = $category;
        $this->type = $type;
        $this->lang = $lang;
    }

    /**
     * @return string Get AdditionalPoint's category
     */
    public function getCategory(){
        return $this->category;
    }

    /**
     * @return string Get AdditionalPoint's type
     */
    public function getType(){
        return $this->type;
    }

    /**
     * @return string Get AdditionalPoint's language
     */
    public function getLang(){
        return $this->lang;
    }

 }