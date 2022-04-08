<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Branch;
use DataTables;

class BranchController extends Controller
{
    public function index(){
        return view('admin.branch');
    }
    
    public function addbranch(Request $request){
        $validator=\Validator::make($request->all(),[
            'branch_name'=>'required',
            'branch_phone'=>'required',
            'branch_address'=>'required',
        ]);

        if(!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
        
            Branch::create([
                'branch_name'=>$request->branch_name,
                'branch_address'=>$request->branch_address,
                'branch_phone'=>$request->branch_phone,
            ]);

            return response()->json(['msg'=>'New Branch Add Successfully']);

        }
    }

    public function getbranchlist(Request $request){

        if ($request->ajax()) {
            $data = Branch::get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<button class="edit btn btn-primary btn-sm " data-id="'.$row['id'].'"  id="EditBranch">Edit</button> <button class="delete btn btn-secondary btn-sm" data-id="'.$row['id'].'"  id="DeleteBranch">Delete</button>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

    }

    public function getbranchdetails(Request $request){
        $branch_id=$request->branch_id;
        $branchDetails=Branch::find($branch_id);
        return response()->json(['details'=>$branchDetails]);
    }

    public function updatebranchdetails(Request $request){

        $branch_id=$request->bid;

        $validator=\Validator::make($request->all(),[
            'branch_name'=>'required',
            'branch_phone'=>'required',
            'branch_address'=>'required',
        ]);

        if(!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
            $branch=Branch::find($branch_id);
            $branch->branch_name=$request->branch_name;
            $branch->branch_address=$request->branch_address;
            $branch->branch_phone=$request->branch_phone;
            $branch->save();

            return response()->json(['msg'=>'Branch Update Successfully']);
        }
    }

    public function deletebranch(Request $request){
        $branch_id=$request->branch_id;
        $branchDetails=Branch::find($branch_id)->delete();

            return response()->json(['code'=>1,'msg'=>'Branch Deleted Successfully']);
        
    }

} 
