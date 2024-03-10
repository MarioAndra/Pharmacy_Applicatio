<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Traits\notification_Mail;
use App\Models\Product;
use App\Http\Requests\Users\{loginRequest};
use App\Notifications\statues_product;
use Illuminate\Support\Facades\{
    Notification,
    Auth
};

class AdminController extends BaseController
{
    use notification_Mail;

    public function login(loginRequest $request){
        if(!Auth::attempt($request->only('email', 'password'))){
            return $this->sendError('', 'Invalid', 401);
        }
        $token = Auth::user()->createToken('')->plainTextToken;
        return $this->sendResponse($token, 'login successfully');
    }


    public function accept($id){
        $product=Product::find($id);
        if(!$product){
            return $this->sendError('','Invalid',401);
        }
        $product->update(['status'=>'accepted']);
            $this->send_notify($product,Auth::user(),'accepted');

         return $this->sendResponse('','the product has been accepted');
}



    public function reject($id){
        $product=Product::find($id);
        if(!$product){

            return $this->sendError('','Invalid',401);
        }
        $product->update(['status'=>'rejected']);

            $this->send_notify($product,Auth::user(),'rejected');

        return $this->sendResponse('','the product has been rejected');
    }
}
