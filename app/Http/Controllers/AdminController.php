<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Traits\notification_Mail;
use App\Traits\Products;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\Users\{loginRequest};
use App\Notifications\statues_product;
use Illuminate\Support\Facades\{
    Notification,
    Auth
};

class AdminController extends BaseController
{
    use notification_Mail,Products;

    public function login(loginRequest $request){
        if(!Auth::attempt($request->only('email', 'password'))){
            return $this->sendError('', 'Invalid', 401);
        }
        $token = Auth::user()->createToken('')->plainTextToken;
        return $this->sendResponse($token, 'login successfully');
    }



    public function acceptOrReject(Request $request ,$id){
        $product=Product::find($id);
        if(!$product){
            return $this->sendError('','Not Found',401);
        }
        $this->Status_product($product,$request->status,Auth::user()->name);
        return $this->sendResponse('',"the product has been  $request->status");

    }


}
