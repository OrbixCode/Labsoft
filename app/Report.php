<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $table='reports';
    protected $fillable=['id','user_id','branch_id','doctor_id','gender_id','ti','patient_name','patient_age','patient_contact','test_result'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function gender() {
        return $this->belongsTo('App\Forgender');
    }

    public function doctor() {
        return $this->belongsTo('App\Doctor');
    }

    public function branch() {
        return $this->belongsTo('App\Branch','branch_id');
    }

    public function testreport(){
        return $this->belongsTo('App\TestReport','report_id');
    }

    public function testparareports() {
        return $this->hasMany('App\TestParaReport');
    }

}