<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Testpara extends Model
{
    protected $table='testparameters';
    protected $fillable=['id','testsetup_id','test_parameter_name','normal_range_male','normal_range_female','normal_range_infant','test_unit'];

    public function testsetup()
    {
        return $this->belongsTo('App\Testsetup');
    } 

    public function testparareports() {
        return $this->hasMany('App\TestParaReport');
    }
}
