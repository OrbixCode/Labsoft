<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use Auth;
use App\Report;
use App\TestReport;

class DatedController extends Controller
{
    

    public function dated(){
        return view('cashier.dated');
    }

    function datesearch(Request $request){
       


        if ($request->ajax()) {
            
            $branch_id=Auth::user()->branch_id;
            $from=$request->from_date;
            $to=$request->to_date;
            $data=Report::where('time','>=',$from)
            ->where('time','<=',$to)
            ->where('branch_id',$branch_id)
            ->get();

            
            $money=TestReport::where('time','>=',$from)
            ->where('time','<=',$to)
            ->where('branch_id',$branch_id)
            ->get();

            $dailyMoney = 0;
        foreach($money as $item){
            $dailyMoney +=$item->testsetup->test_charge;
        }

           
        }

        return response()->json([$data,$dailyMoney]);
    }
    

    public function getdatedreportlist(Request $request){

        if ($request->ajax()) {
            
            $branch_id=Auth::user()->branch_id;
            $data = Report::where('branch_id',$branch_id)->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '

                    <a  class="btn btn-success btn-sm" href="'.route('report.print',$row['id']).'" target="_blank" >Print Report</a> 
                     ';
                    return $actionBtn;
                })



                ->rawColumns(['action','show'])
                ->addColumn('show', function($data) {


                    if($data->status == '0'){
                        $pendingBtn='<button class="edit btn btn-danger btn-sm " disabled data-id="'.$data['id'].'"  id="EditStatus1">Pending</button>';
                        return $pendingBtn;
                    }else{
                           $publishBtn='<button class="edit btn btn-success btn-sm " disabled data-id="'.$data['id'].'"  id="EditStatus0">Issued</button>';
                        return $publishBtn;
                    }
                })
                ->make(true);
        }

    }




}
