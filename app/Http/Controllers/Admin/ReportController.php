<?php

namespace App\Http\Controllers\Admin;

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



class ReportController extends Controller
{
    public function index(){
        $testsetup=Testsetup::get();
        $genders=Forgender::get();
        $doctors=Doctor::get();
        $testpara=Testpara::get();
        $branchadd = Branch::where('id',Auth::user()->branch_id)->first();
        // dd($branchadd);
        return view('admin.report')->with(compact('testsetup','genders','doctors','branchadd','testpara'));
      
        // $get=Auth::user()->with('branch');
        // $branchaddress = Branch::where('id','=', Auth::user()->branch_id)->get();

        // dd($get);
    }
    
    public function getTestpara(Request $request)
    {
        $data['testparameters'] = Testpara::where("testsetup_id",$request->testsetup_id)
                    ->get(["test_parameter_name","id"]);
        return response()->json($data);
    }

    public function getTestprice(Request $request)
    {
        $data['testprice'] = Testsetup::where("id",$request->testsetup_id)
                    ->get(["test_charge","id"]);
        return response()->json($data);
    }

    public function addreport(Request $request){

        
        $validator=\Validator::make($request->all(),[
            'testsetup_id'=>'required',
            'gender_id'=>'required',
            'patient_name'=>'required',
            'patient_age'=>'required',
            'patient_contact'=>'required',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if(!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
            
            $user=User::create([
                'role_id'=>'2',
                'branch_id'=>$request->branch_id,
                'name'=>$request->patient_name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
            ]);

            $currentTime = date('Y-m-d'); 
            $reports=new Report();
                $reports->user_id=$user->id;
                $reports->gender_id=$request->gender_id;
                $reports->branch_id=$request->branch_id;
                $reports->doctor_id=$request->doctor_id;
                $reports->patient_name=$request->patient_name;
                $reports->patient_age=$request->patient_age;
                $reports->patient_contact=$request->patient_contact;
                $reports->time=$currentTime;
   
            $reports->save();
          
        $test_id = $request->testsetup_id;
        $testTime=date('Y-m-d');
        $n=count($test_id);
        // dd($n);

        for($i=0; $i<$n; $i++){
            $data=[
                'report_id' => $reports->id, 
                'test_id' => $test_id[$i],
                'time'=> $testTime,
                'branch_id'=>$request->branch_id,
            
            ];

            $test[]=$data;
        }

        foreach($test as $row){
            TestReport::create($row);
        }
        return response()->json(['msg'=>'New Report Add']);

    }

    }

    public function getreportlist(Request $request){

        if ($request->ajax()) {
            $data = Report::get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '

                    <a  class="btn btn-success btn-sm" href="'.route('bill.print',$row['id']).'" >Reciept</a> <button class="edit btn btn-secondary btn-sm " data-id="'.$row['id'].'"  id="TestView">View</button> <button class="delete btn btn-danger btn-sm" data-id="'.$row['id'].'"  id="DeleteTestReport">X</button>
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
        // dd($testnameDetails);
        return response()->json(['details'=>$testDetails,'testnames'=>$testnameDetails]);
    }

    public function gettestview(Request $request){
        $report_id=$request->report_id;
        $testDetails=Report::with('gender','user')->find($report_id);
        // dd($testDetails);
        return response()->json(['details'=>$testDetails]);
    }

    public function deletereport(Request $request){
        $report_id=$request->report_id;
        $reportdelete=Report::find($report_id);
        $userdelete=User::where('id',$reportdelete->user_id);
        $testdelete=TestReport::where('report_id',$report_id);
        $testparadelete=TestParaReport::where('report_id',$report_id);
        // dd($reportdelete->user_id);
        $userdelete->delete();
        $testdelete->delete();
        $testparadelete->delete();
        $reportdelete->delete();
        return response()->json(['code'=>1,'msg'=>'Report Deleted']);
        
    }

    public function statusreport1(Request $request){
        $status_id=$request->status_id;
        $report=Report::where('id','=',$status_id)->update([
            'status'=>'1',
        ]);
        // dd($report);
        return response()->json(['code'=>1,'msg'=>'Report Issued']);
    }

    public function statusreport0(Request $request){
        $status_id=$request->status_id;
        $report=Report::where('id','=',$status_id)->update([
            'status'=>'0',
        ]);
        // dd($report);
        return response()->json(['code'=>1,'msg'=>'Report Pending']);
    }

    public function bill($id){
        $currentTime = date('Y-m-d'); 
        $reports=Report::with('gender','branch')->find($id);
        $testreportitem=TestReport::with('testsetup')->where('report_id',$id)->get();
        $payment_recepit = 0;
        foreach($testreportitem as $item){
            $payment_recepit +=$item->testsetup->test_charge;
        }
        // dd($payment_recepit);
        return view('admin.reciept')->with(compact('reports','testreportitem','payment_recepit','currentTime'));
    }
    
}
