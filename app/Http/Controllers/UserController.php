<?php

namespace App\Http\Controllers;
use App\Traits\Image;
use Illuminate\Http\Request;
use App\Http\Requests\Users\{
    requestUser,
    requestUpdateUser,
    requestPassword
};
use App\Http\Requests\Filter\{
    FilterRequest
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
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }


    public function index(Request $request){


         $user=User::with(['photos','products.photos'])->filter($request->all())->get();

         return $this->sendResponse($user,'done');
    }




    public function show(User $user)
    {
        $user->load(['products.photos'])->get();
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




   public function Update(requestUpdateUser $request,User $user)
    {


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



    public function updatePassword(requestPassword $requestPasssowrd,User $user){

        if($user){
            $user->forceFill([
                'password'=>$requestPasssowrd->password,
            ])->save();
            return $this->sendResponse('','password updated  successfully');
        }
        return $this->sendError('','User not found');

}



    public function destroy(User $user)
    {


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
