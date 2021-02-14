<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AccessList;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(10);
        return view('user.index', ['users' => $users])->with('no', 1);
    }

    public function create()
    {
        return view('user.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'confirmed|min:8',
            'view' => 'required',
            'edit' => 'required',
            'add' => 'required',
            'delete' => 'required',
        ]);
        DB::beginTransaction();
        try{ 
            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = Hash::make($request->input('password'));
            $user->save();

            $access = New AccessList;
            $access->user_id = $user->id;
            $access->view = $request->input('view');
            $access->edit = $request->input('edit');
            $access->add = $request->input('add');
            $access->delete = $request->input('delete');
            $access->save();
            DB::commit();
            return redirect()->route('user.list')->with('message','User created successfully');
            } catch(\Exception $e){
            DB::rollback();    
            return redirect()->route('user.list')->with('message','Something went wrong');
        }
    }

    public function edit($id)
    {
        $user= User::find($id);
        return view('user.edit', ['user' => $user]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'view' => 'required',
            'edit' => 'required',
            'add' => 'required',
            'delete' => 'required',
        ]);

        $user = User::find($id);
        if(!empty($user)){
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            if(!empty($request->input('password'))){
                $user->password = Hash::make($request->input('password'));
                
            }
            $user->save();

            AccessList::where('user_id', $id)
                    ->update([
                                'view' => $request->input('view'),
                                'edit' => $request->input('edit'),
                                'add' => $request->input('add'), 
                                'delete' => $request->input('delete'), ]);
            return redirect()->route('user.list')->with('message','Updated successfully');
        }else{
            return redirect()->route('user.list')->with('message','Invalid request');
        }
        
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $access = AccessList::where('user_id', $id)->first();
            if(!empty($user)){
            $access->delete();
            $user->delete();
            return redirect()->route('user.list')->with('message','Updated successfully');
            }else{
            return redirect()->route('user.list')->with('message','Invalid request');
        }
    }
}
