<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Testsetup;
use DataTables;

class TestSetupController extends Controller
{
    public function index(){
        return view('admin.testsetup');
    }
    
    public function addtestsetup(Request $request){
        $validator=\Validator::make($request->all(),[
            'test_name'=>'required',
            'report_heading'=>'required',
            'carry_out'=>'required',
            'test_charge'=>'required',
            'report_completion'=>'required',
        ]);

        if(!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
        
            Testsetup::create([
                'test_name'=>$request->test_name,
                'report_heading'=>$request->report_heading,
                'carry_out'=>$request->carry_out,
                'test_charge'=>$request->test_charge,
                'report_completion'=>$request->report_completion,
            ]);

            return response()->json(['msg'=>'New Test Add Successfully']);

        }
    }

    public function gettestsetuplist(Request $request){

        if ($request->ajax()) {
            $data = Testsetup::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<button class="edit btn btn-primary btn-sm " data-id="'.$row['id'].'"  id="EditTest">Edit</button> <button class="delete btn btn-secondary btn-sm" data-id="'.$row['id'].'"  id="DeleteTest">Delete</button>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

    }

    public function gettestsetupdetails(Request $request){
        $testsetup_id=$request->testsetup_id;
        $testDetails=Testsetup::find($testsetup_id);
        return response()->json(['details'=>$testDetails]);
    }

    public function updatetestsetupdetails(Request $request){

        $test_id=$request->tsid;

        $validator=\Validator::make($request->all(),[
            'test_name'=>'required',
            'report_heading'=>'required',
            'carry_out'=>'required',
            'test_charge'=>'required',
            'report_completion'=>'required',
        ]);

        if(!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
            $test=Testsetup::find($test_id);
            $test->test_name=$request->test_name;
            $test->report_heading=$request->report_heading;
            $test->carry_out=$request->carry_out;
            $test->test_charge=$request->test_charge;
            $test->report_completion=$request->report_completion;
            $test->save();

            return response()->json(['msg'=>'Test Update Successfully']);
        }
    }

    public function deletetestsetup(Request $request){
        $testsetup_id=$request->testsetup_id;
        Testsetup::find($testsetup_id)->delete();

            return response()->json(['code'=>1,'msg'=>'Test Deleted Successfully']);
        
    }

}
