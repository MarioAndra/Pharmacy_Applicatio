<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends BaseController
{
    public function createUser(Request $request){
       $validat=Validator::make($request->all(),[
        'name'=>'required',
        'email'=>'required',
        'number'=>'required',
        'password'=>'required'
       ]);
       if($validat->fails()){
        return $this->sendError('',$validat->errors(),500);
       }
       else{
        $input=$request->all();
        $input['password']=Hash::make($input['password']);
        $user=User::create($input);
        return $this->sendResponse('','user create successfully');
       }

    }

    public function showUser(){
        $user=User::get()->all();
        return $this->sendResponse($user,'Done');
    }

    public function deleteUser($id){
        $user=User::find($id);
        if($user){
        $user->delete();
        return $this->sendResponse('','Done');
        }
        else{
            return $this->sendError('','user not found',500);
        }
    }
    public function updatUser(Request $request,$id){
        $user=User::find($id);
        if($user){
        $validat=Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required',
            'number'=>'required',
            'password'=>'required'
           ]);
           if($validat->fails()){
            return $this->sendError('',$validat->errors(),500);
           }
           else{
            $user->name=$request->name;
            $user->email=$request->email;
            $user->password=$request->password;
            $user->number=$request->number;
            $user->save();
            return $this->sendResponse('','user updated successfully');
        }
        }
        return $this->sendError('','User not found');


    }

}
