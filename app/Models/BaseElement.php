<?php

namespace App\Models;

class BaseElement implements Printable {
    public $title;
    public $description;
    public $visible;
    public $months;

    public function __construct($title, $description){
        $this->setTitle($title);
        $this->description=$description;
        $this->visible=true;
    }

    public function getTitle(){
        return $this->title;
    }

    public function setTitle($t){
        if($t==''){
            $this->title='N/A';
        }
        else{
            $this->title=$t;
        }
    }

    public function getDuration(){
        $years = floor($this->months / 12);
        $extraMonths = $this->months % 12;
    
        if($years>0)
            $msj="$years years ";
    
        return $msj."$extraMonths months";
    }

    public function getDescription(){
        return $this->description;
    }
}