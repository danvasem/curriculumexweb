<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model {

    protected $table='jobs';

    public function getDuration(){
        $years = floor($this->months / 12);
        $extraMonths = $this->months % 12;
        
        $msj='Job Duration: ';

        if($years>0)
            $msj.="$years years ";
    
        return $msj."$extraMonths months";
    }

}