<?php

namespace App\Http\Controllers;
use App\Traits\Image;
use Illuminate\Http\Request;
use App\Http\Requests\Users\{
    requestUser,
    requestUpdateUser,
    requestPassword
};

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Concerns\HasAttributes;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class UserController extends BaseController
{
    use Image;

    public function index(){
        $user=User::with(['photos','products.photos'])->get();
        return $this->sendResponse($user,'done');
    }




    public function show(string $id)
    {
        $user=User::find($id)->with(['products.photos'])->get();
        return $this->sendResponse($user,'Done');
    }



    public function store(requestUser $request, requestPassword $passwordRequest)
    {
        $user = new User;
        $user->fill($request->all());
        $user->password = $passwordRequest->input('password');
        $user->save();
        $photoPath = $this->storeImage($request->file('image'),$user,'/images/user_photo/');
        return $this->sendResponse($user,'user created  successfuly');

    }




   public function Update(requestUpdateUser $request,string $id)
    {
        $user=User::find($id);
        if($user){
            $request->except('password');
            $user->update($request->all());
            if($request->hasFile('image')){
                $photoPath=$this->updateImage($request->file('image'),$user,'/images/user_photo/');
             }
            return $this->sendResponse($user,'user updated successfully');
        }
    return $this->sendError('','User not found');
}



    public function updatePassword(requestPassword $requestPasssowrd,$id){
        $user=User::find($id);
        if($user){
            $user->forceFill([
                'password'=>$requestPasssowrd->password,
            ])->save();
            return $this->sendResponse('','password updated  successfully');
        }
        return $this->sendError('','User not found');

}



    public function destroy($id)
    {
        $user=User::find($id);
        if(!$user){
            return $this->sendError('','user not found',403);
        }
        else{
      return  DB::transaction(function () use ($user) {
                $user->photos()->delete();
                $user->delete();
                return $this->sendResponse('','User deleted successfuly ');
         });

        }

    }
}
