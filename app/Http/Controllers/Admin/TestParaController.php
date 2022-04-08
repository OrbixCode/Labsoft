<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Testpara;
use App\Testsetup;
use DataTables;

class TestParaController extends Controller
{
    public function index(){
        $testsetup=Testsetup::get();
        return view('admin.testpara')->with(compact('testsetup'));
    }
    
    public function addtestpara(Request $request){
        $validator=\Validator::make($request->all(),[
            'testsetup_id'=>'required',
            'test_parameter_name'=>'required',
            'normal_range_male'=>'required',
            'normal_range_female'=>'required',
            'normal_range_infant'=>'required',
            'test_unit'=>'required',
        ]);

        if(!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
        
            Testpara::create([
                'testsetup_id'=>$request->testsetup_id,
                'test_parameter_name'=>$request->test_parameter_name,
                'normal_range_male'=>$request->normal_range_male,
                'normal_range_female'=>$request->normal_range_female,
                'normal_range_infant'=>$request->normal_range_infant,
                'test_unit'=>$request->test_unit,
            ]);

            return response()->json(['msg'=>'New Test Parameter Add Successfully']);

        }
    }

    public function gettestparalist(Request $request){

        if ($request->ajax()) {
            $data = Testpara::with('testsetup')->get();
            // join('testsetups', 'testsetups.id', '=' ,'testparameters.id')
            //          ->select('testparameters.*', 'testsetups.test_name') 
            //          ->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<button class="edit btn btn-primary btn-sm " data-id="'.$row['id'].'"  id="EditTest">Edit</button> <button class="delete btn btn-secondary btn-sm" data-id="'.$row['id'].'"  id="DeleteTest">Delete</button>';
                    return $actionBtn;
                })
                // ->editColumn('testsetup_name', function($data){
                //     return $data->test_name;
                // })

                ->rawColumns(['action'])
                
                ->make(true);
        }

    }

    public function gettestparadetails(Request $request){
        $test_id=$request->test_id;
        $testDetails=Testpara::find($test_id);
        return response()->json(['details'=>$testDetails]);
    }

    public function updatetestparadetails(Request $request){

        $test_id=$request->tid;

        $validator=\Validator::make($request->all(),[
            'testsetup_id'=>'required',
            'test_parameter_name'=>'required',
            'normal_range_male'=>'required',
            'normal_range_female'=>'required',
            'normal_range_infant'=>'required',
            'test_unit'=>'required',
        ]);

        if(!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
            $test=Testpara::find($test_id);
            $test->testsetup_id=$request->testsetup_id;
            $test->test_parameter_name=$request->test_parameter_name;
            $test->normal_range_male=$request->normal_range_male;
            $test->normal_range_female=$request->normal_range_female;
            $test->normal_range_infant=$request->normal_range_infant;
            $test->test_unit=$request->test_unit;
            $test->save();

            return response()->json(['msg'=>'Test Parameter Update Successfully']);
        }
    }

    public function deletetestpara(Request $request){
        $test_id=$request->test_id;
        Testpara::find($test_id)->delete();

            return response()->json(['code'=>1,'msg'=>'Test Deleted Successfully']);
        
    }

}
