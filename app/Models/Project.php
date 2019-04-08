<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model{

    protected $table='projects';

    public function getDuration(){
        $years = floor($this->months / 12);
        $extraMonths = $this->months % 12;
        
        $msj='Job Duration: ';

        if($years>0)
            $msj.="$years years ";
    
        return $msj."$extraMonths months";
    }
}