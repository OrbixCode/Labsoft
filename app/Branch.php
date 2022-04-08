<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table='branches';
    protected $fillable=['branch_name','branch_phone','branch_address'];

    
public function users(){
    return $this->hasMany('App\User');
}

public function reports(){
    return $this->hasMany('App\Report');
}

public function doctors() {
    return $this->hasMany('App\Doctor');
  }

}

