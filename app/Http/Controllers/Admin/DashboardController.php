<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Report;
use App\Doctor;
use App\TestReport;
use App\Testsetup;

class DashboardController extends Controller
{
      public function index(){
        $pend = Report::where('status','=', 0)->get();
        $pending=$pend->count();
        $issue = Report::where('status','=', 1)->get();
        $issued=$issue->count();
        $doctor=Doctor::get();
        $doctors=$doctor->count();
        // $test=Testsetup::first();

        // $testDailyMoney=TestReport::where('test_id',$test->id)
        // ->whereDate('created_at', date('Y-m-d'))
        // ->with('testsetup')->get();

        $testDaily=Report::whereDate('created_at', date('Y-m-d'))
        ->get();

        // $dailyMoney = 0;
        // foreach($testDailyMoney as $item){
        //     $dailyMoney +=$item->testsetup->test_charge;
        // }

      
        return view('admin.dashboard')->with(compact('pending','issued','doctors','testDaily'));
    }
}
