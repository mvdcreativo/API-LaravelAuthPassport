<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required'],
            'email' => ['required'] 
        ]);

        $name = $request->name;
        $email = $request->email;
        $validateUser = User::where('email', $email)->get();


        if(count($validateUser)>=1){
            return response()->json(["message" => "El Usuaio ".$name." ya existe!!!"], 400);
        }else{

            $user = new User;
            $user->name = $name;
            $user->email = $email;
            $user->role = $request->role;
            $user->address = $request->address;
            $user->city = $request->city;
            $user->phone = $request->phone;
            $user->ci = $request->ci;
            $user->rut = $request->rut;
            $user->company = $request->company;
            $user->discount = $request->discount;
            $user->save();

            return response()->json($user, 200);
        }    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id); 

        return response()->json($user, 200);    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id, Request $request )
    {
        $name = $request->name;
        $email = $request->email;
        $validateUser = User::where('email', $email)->where('id', '!=', $id)->get();


        if(count($validateUser)>=1){
            return response()->json(["message" => "El Usuaio ".$name." ya existe!!!"], 400);
        }else{

            $user = User::find($id);
            $user->name = $name;
            // $user->email = $email;
           
            $user->address = $request->address;
            $user->city = $request->city;
            $user->phone = $request->phone;
            $user->ci = $request->ci;
            $user->rut = $request->rut;
            $user->company = $request->company;
            $user->discount = $request->discount;
            $user->save();

            return response()->json($user, 200);
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
        $user = User::find($id);
        $user->delete();

        return response()->json($user, 200);
    }
}
