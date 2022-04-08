<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Report;
use App\TestReport;

class DatedController extends Controller
{
    

    public function issued(){
        return view('admin.dated');
    }

    function datesearch(Request $request){
       


        if ($request->ajax()) {
            $from=$request->from_date;
            $to=$request->to_date;
            $data=Report::where('time','>=',$from)
            ->where('time','<=',$to)
            ->get();


            $money=TestReport::where('time','>=',$from)
            ->where('time','<=',$to)
            ->get();

            $dailyMoney = 0;
        foreach($money as $item){
            $dailyMoney +=$item->testsetup->test_charge;
        }

           
        }

        // dd($dailyMoney);

        return response()->json([$data,$dailyMoney]);
    }
    

    public function getdatedreportlist(Request $request){

        if ($request->ajax()) {
            $data = Report::get();

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
