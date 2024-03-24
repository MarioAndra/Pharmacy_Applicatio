<?php


namespace App\Http\Controllers;
use Validator;
use App\Traits\Image;
use App\Traits\notification_database;
use App\Http\Requests\Products\{
    requestProduct,
    requestUpdateProduct
};
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
class ProductController extends BaseController
{


    use Image,notification_database;


    public function __construct()
    {
        $this->authorizeResource(Product::class, 'product');
    }

    public function index(Request $request){


        $product=Product::with(['photos','user'])
        ->status($request->status)
        ->filter($request->all())
        ->filters($request->all())
        ->get();
        return $this->sendResponse($product,'done');
    }



    public function store(requestProduct $request)
    {
        return DB::transaction(function () use ($request)  {
            $product=Product::create($request->all());
            foreach ($request->file('images') as $image) {
                $photoPath = $this->storeImage($image,$product,'/images/product_photo/');
            }
            $this->send_notification($product);
             return $this->sendResponse($product,'product create successfully, please wait to accept it by admin.');
     });
 }


 public function show(Product $product)
 {

     if($product){

         return $this->sendResponse($product,'done');
     }
     return $this->sendError('','Invalid',500);
 }





     public function Update(requestUpdateProduct $request,Product $product){

        if($product){

          $product->update($request->all());
            if($request->hasFile('images')){
            foreach ($request->file('images') as $newImage) {
                $photoPath=$this->updateImageProduct($newImage,$product,'/images/product_photo/');
            }
            return $this->sendResponse($product,'Product updated successfully');
        }

    }
        return $this->sendError('','product not found');
}


    public function destroy(Product $product)
    {

        if(!$product){
            return $this->sendError('','product not found');
        }
        else{
          return  DB::transaction(function () use ($product) {
                $product->photos()->delete();
                $product->delete();
                return $this->sendResponse('','Product deleted successfully');
            });

        }
    }
}
