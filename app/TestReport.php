<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestReport extends Model
{
    protected $table='test_reports';
    protected $fillable=['id','report_id','test_id','branch_id','time'];

        public function reports()
    {
        return $this->hasMany('App\Report');
    } 

    public function testsetup()
    {
        return $this->belongsTo('App\Testsetup','test_id');
    } 
}
