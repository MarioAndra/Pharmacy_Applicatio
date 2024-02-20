<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\requestCreateUser;
use App\Http\Requests\requestUpdateUser;
use App\Http\Requests\PasswordRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasAttributes;
use Validator;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends BaseController
{
    public function createUser(requestCreateUser $request,PasswordRequest $requestPasssowrd){
        $input=$request->all();
        $inputPassword=$requestPasssowrd->all();
        $user=new User;
        $user->fill($input);
        $user->password = $inputPassword['password'];
        $user->save();

        return $this->sendResponse($user,'user create successfully');

    }





    public function updatUser(requestUpdateUser $request,$id){
        $user=User::find($id);
        if($user){
            $request->except('password');
           // $request->password_confirm=except('password_confirm');
            $user->update($request->all());

            return $this->sendResponse('','user updated successfully');
        }

        return $this->sendError('','User not found');
    }


    public function updateUserPassword(PasswordRequest $requestPasssowrd,$id){
        $user=User::find($id);
        if($user){
            $user->forceFill([
                'password'=>$requestPasssowrd->password,

            ])->save();
            return $this->sendResponse('','password updated  successfully');

        }
        return $this->sendError('','User not found');


    }







    public function showProductUser($id){
        $user=User::with('products')->find($id);
        if($user){
            return $this->sendResponse($user,'Done');
        }
        else {
            return $this->sendError('','user not found',500);
        }

    }

    public function showUser(){
        $user=User::get()->all();
        return $this->sendResponse($user,'Done');
    }

    public function deleteUser($id){
        $user=User::find($id);
        if($user){

        $user->products()->delete();
        $user->delete();
        return $this->sendResponse('','User and his products deleted successfuly ');
        }
        else{
            return $this->sendError('','user not found',500);
        }
    }

}
