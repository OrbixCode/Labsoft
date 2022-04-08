<?php

namespace App\Http\Controllers\Cashier;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Auth;
use App\Testpara;
use App\Testsetup;
use App\Forgender;
use App\Doctor;
use App\Report;
use App\Branch;
use App\User;
use App\TestReport;
use App\TestParaReport;
use DataTables;


class PendingIssuedController extends Controller
{
    public function index(){
        $testsetup=Testsetup::get();
        $testpara=Testpara::get();
        return view('cashier.pending')->with(compact('testpara','testsetup'));
    }

    public function issued(){
        return view('cashier.issued');
    }

    
    public function getpendingreportlist(Request $request){

        if ($request->ajax()) {
            $branch_id=Auth::user()->branch_id;
            $data = Report::where('branch_id',$branch_id)
            ->where('status','=', 0)->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '

                    <button class="edit btn btn-primary btn-sm " data-id="'.$row['id'].'"  id="TestResult">Add Result</button> 
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



    public function getissuedreportlist(Request $request){

        if ($request->ajax()) {
            $branch_id=Auth::user()->branch_id;
            $data = Report::where('branch_id',$branch_id)
            ->where('status','=', 1)->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '

                    <a  class="btn btn-success btn-sm" href="'.route('creport.print',$row['id']).'" target="_blank" >Print Report</a> 
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


    public function getreportdetails(Request $request){
        $report_id=$request->report_id;
        $testDetails=Report::with('gender','user')->find($report_id);
        $testnameDetails=TestReport::where('report_id',$report_id)->with('testsetup')->get();
        return response()->json(['details'=>$testDetails,'testnames'=>$testnameDetails]);
    }

    public function addtestreportresult(Request $request){

        $report_id=$request->trid;
        $validator=\Validator::make($request->all(),[
            'testpara_id'=>'required',
        ]);

        if(!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
           

            $currentTime = date('Y-m-d'); 
            $reports=Report::find($report_id);
            $reports->issue_date=$currentTime;
            $reports->report_description=$request->report_description;
            if ($request->hasfile('report_image')) {
                $file = $request->file('report_image');
                $extension = $file->getClientOriginalExtension(); // getting image extension
                $filename = time() . '.' . $extension;
                $file->move('uploads/', $filename);    
                $reports->report_image = $filename;
            } else {
                return $request;
                $reports->report_image = '';
            }
            $reports->status='1';
            $reports->save();    
    
            $testpara_id = $request->testpara_id;
            $test_result = $request->test_result;
        $n=count($testpara_id);
        // dd($n);

        for($i=0; $i<$n; $i++){
            $data=[
                'report_id' => $report_id, 
                'testpara_id' => $testpara_id[$i],
                'test_result'=>$test_result[$i],
            ];

            $test[]=$data;
        }

        foreach($test as $row){
            TestParaReport::create($row);
        }
            return response()->json(['msg'=>'Test Result Successfully']);
        }
    }


    public function reportprint($id){
        set_time_limit(300);
        $id = $id;
        $reports=Report::where('id','=',$id)->with('gender','user')->get();
        $report=Report::where('id','=',$id)->first();
        $reportnames=TestReport::where('report_id',$id)->with('testsetup')->get();
        $reportparas=TestParaReport::where('report_id',$id)->with('testpara')->get();
        $doctors=Doctor::where('branch_id',Auth::user()->branch_id)->get();


        return view('patient.pdf.report')->with(compact('reports','reportnames','reportparas','doctors'));

  }
}
