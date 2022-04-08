<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestParaReport extends Model
{
    protected $table='test_para_reports';

    protected $fillable=['id','report_id','testpara_id','test_result'];

    public function testpara()
    {
        return $this->belongsTo('App\Testpara','testpara_id');
    } 

    public function report() {
        return $this->belongsTo('App\Report');
    }
    
}
