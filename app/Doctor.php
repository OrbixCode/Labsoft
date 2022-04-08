<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
   protected $table='doctors';
   protected $fillable=['branch_id','doctor_name','doctor_information','doctor_phone','doctor_clinic','doctor_shortcode'];

   public function reports() {
      return $this->belongsTo('App\Report');
  }

  public function branch() {
   return $this->belongsTo('App\Branch');
}
}
