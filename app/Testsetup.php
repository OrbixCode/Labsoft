<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Testsetup extends Model
{
    protected $table='testsetups';
    protected $fillable=['id','test_name','report_heading','carry_out','test_charge','report_completion'];


    public function testparas() {
        return $this->hasMany('App\Testpara');
    }

    public function testreports() {
        return $this->hasMany('App\TestReport');
    }
  
}
