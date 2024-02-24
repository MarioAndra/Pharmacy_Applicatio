<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\requestUser;
use App\Http\Requests\PasswordRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasAttributes;
use Validator;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Photo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
class UserController extends BaseController
{


    public function store(requestUser $request,PasswordRequest $requestPasssowrd)
    {
        $input=$request->all();
        $inputPassword=$requestPasssowrd->all();
        $user=new User;
        $user->fill($input);
        $user->password = $inputPassword['password'];
        $user->save();
        $image = $request->file('image');
        $filename = time().'.'.$image->getClientOriginalName();
        $image->move(public_path('images'), $filename);
        $photo = new Photo;
        $photo->rcs = '/images/'.$filename;
        $user->photos()->save($photo);

        return $this->sendResponse($user,'user create successfully');
    }


    public function show(string $id)
    {
        $user=User::find($id)->with('photos')
        ->with('products')->get()->all();
        return $this->sendResponse($user,'Done');
    }


   public function Update(requestUser $request,string $id)
    {
        $user=User::find($id);
        if($user){
            $request->except('password');
            $user->update($request->all());
            $image=$request->file('image');
            $filename=time().'.'.$image->getClientOriginalName();
            $image->move(public_path('images'), $filename);
            $photo = $user->photos()->first();
            if ($photo) {
                    $photo->update(['rcs' => $filename]);
                    $photo->save();
        }
            return $this->sendResponse($user,'user updated successfully');
    }

        return $this->sendError('','User not found');
    }

    public function updatePassword(PasswordRequest $requestPasssowrd,$id){
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
        if($user){
        $user->products()->delete();
        $user->photos()->delete();
        $user->delete();
        return $this->sendResponse('','User and his products deleted successfuly ');
        }
        else{
            return $this->sendError('','user not found',500);
        }
    }
}
