<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Role;
use App\Branch;
use DataTables;

class UserController extends Controller
{
    public function index(){
        $roles=Role::get();
        $branches=Branch::get();
        return view('admin.user')->with(compact('roles','branches'));
    }
    
    public function adduser(Request $request){
        $validator=Validator::make($request->all(),[
            'role_id'=>'required',
            'branch_id' => 'required|unique:users',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if(!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
        
            User::create([
                'role_id'=>$request->role_id,
                'branch_id'=>$request->branch_id,
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>Hash::make($request->password),
            ]);

            return response()->json(['msg'=>'New User Created']);

        }
    }

    public function getuserlist(Request $request){

        // $data = User::with('role')->get();
        // dd($data);

        if ($request->ajax()) {
            $data = User::with('role','branch')->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<button class="edit btn btn-primary btn-sm " data-id="'.$row['id'].'"  id="EditUser">Edit</button> <button class="delete btn btn-secondary btn-sm" data-id="'.$row['id'].'"  id="DeleteUser">Delete</button>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

    }

    public function getuserdetails(Request $request){
        $user_id=$request->user_id;
        $userDetails=User::find($user_id);
        return response()->json(['details'=>$userDetails]);
    }

    public function updateuserdetails(Request $request){

        $user_id=$request->uid;

        $validator=Validator::make($request->all(),[
            'role_id'=>'required',
            // 'branch_id' => 'required|unique:users',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]);

        if(!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
            $user=User::find($user_id);
            $user->role_id=$request->role_id;
            $user->name=$request->name;
            // $user->branch_id=$request->branch_id;
            $user->email=$request->email;
            $user->password=Hash::make($request->password);
            $user->save();

            return response()->json(['msg'=>'User Update Successfully']);
        }
    }

    public function deleteuser(Request $request){
        $user_id=$request->user_id;
        User::find($user_id)->delete();

            return response()->json(['code'=>1,'msg'=>'Test Deleted Successfully']);
        
    }

}
