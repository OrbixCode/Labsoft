<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Report;
use App\Doctor;
use Auth;
use App\TestReport;
use App\Testsetup;

class DashboardController extends Controller
{
      public function index(){
        $branch_id=Auth::user()->branch_id; 
        $pend = Report::where('branch_id',$branch_id)
        ->where('status','=', 0)->get();
        $pending=$pend->count();
        $issue = Report::where('branch_id',$branch_id)
        ->where('status','=', 1)->get();
        $issued=$issue->count();
        $doctor=Doctor::where('branch_id',$branch_id)->get();
        $doctors=$doctor->count();
        // $test=Testsetup::first();

        // $testDailyMoney=TestReport::where('test_id',$test->id)
        // ->whereDate('created_at', date('Y-m-d'))
        // ->with('testsetup')->get();

        $testDaily=Report::where('branch_id',$branch_id)
        ->whereDate('created_at', date('Y-m-d'))
        ->get();

        // $dailyMoney = 0;
        // foreach($testDailyMoney as $item){
        //     $dailyMoney +=$item->testsetup->test_charge;
        // }
        // dd($testDaily);
        return view('cashier.dashboard')->with(compact('pending','issued','doctors','testDaily'));
    }
}

