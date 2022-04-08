<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Doctor;
use App\Branch;
use Auth;
use DataTables;

class DoctorController extends Controller
{
    public function index(){
        $branchadd = Branch::where('id',Auth::user()->branch_id)->first();
        return view('admin.doctor')->with(compact('branchadd'));
    }
    
    public function adddoctor(Request $request){
        $validator=\Validator::make($request->all(),[
            'doctor_name'=>'required',
            'doctor_clinic'=>'required',
            'doctor_information'=>'required',
            'doctor_phone'=>'required',
            'doctor_shortcode'=>'required',
        ]);

        if(!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
            Doctor::create([
                'branch_id'=>$request->branch_id,
                'doctor_name'=>$request->doctor_name,
                'doctor_phone'=>$request->doctor_phone,
                'doctor_information'=>$request->doctor_information,
                'doctor_clinic'=>$request->doctor_clinic,
                'doctor_shortcode'=>$request->doctor_shortcode,
            ]);

            return response()->json(['msg'=>'New Doctor Add Successfully']);
            // dd($user_id);

        }
    }

    public function getdoctorlist(Request $request){

        if ($request->ajax()) {
            $data = Doctor::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<button class="edit btn btn-primary btn-sm " data-id="'.$row['id'].'"  id="EditDoctor">Edit</button> <button class="delete btn btn-secondary btn-sm" data-id="'.$row['id'].'"  id="DeleteDoctor">Delete</button>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

    }

    public function getdoctordetails(Request $request){
        $doctor_id=$request->doctor_id;
        $doctorDetails=Doctor::find($doctor_id);
        return response()->json(['details'=>$doctorDetails]);
    }

    public function updatedoctordetails(Request $request){

        $doctor_id=$request->bid;

        $validator=\Validator::make($request->all(),[
            'doctor_name'=>'required',
            'doctor_clinic'=>'required',
            'doctor_information'=>'required',
            'doctor_phone'=>'required',
            'doctor_shortcode'=>'required',
        ]);

        if(!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
            $doctor=Doctor::find($doctor_id);
            $doctor->doctor_name=$request->doctor_name;
            $doctor->doctor_phone=$request->doctor_phone;
            $doctor->doctor_information=$request->doctor_information;
            $doctor->doctor_clinic=$request->doctor_clinic;
            $doctor->doctor_shortcode=$request->doctor_shortcode;
            $doctor->save();

            return response()->json(['msg'=>'Doctor Update Successfully']);
        }
    }

    public function deletedoctor(Request $request){
        $doctor_id=$request->doctor_id;
        Doctor::find($doctor_id)->delete();

            return response()->json(['code'=>1,'msg'=>'Doctor Deleted Successfully']);
        
    }

} 
