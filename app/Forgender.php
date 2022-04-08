<?php

namespace App;
use App\Testsetup;

use Illuminate\Database\Eloquent\Model;

class Forgender extends Model
{
    protected $table='forgenders';
    protected $fillable=['id','gender_name'];

    public function testsetup() {
        return $this->hasMany(App\Testsetup::class);
    }

    public function report() {
        return $this->hasMany('App\Report');
    }
}
