<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AccessList;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('user.index', ['users' => $users])->with('no', 1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = $request->input('password');
        $user->save();

        $access = New AccessList;
        $access->user_id = $user->id;
        $access->view = $request->input('view');
        $access->edit = $request->input('edit');
        $access->add = $request->input('add');
        $access->delete = $request->input('delete');
        $access->save();
        
        return redirect()->route('user.list')->with('message','User created successfully');
   
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
            // 'password' => 'min:8',
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
