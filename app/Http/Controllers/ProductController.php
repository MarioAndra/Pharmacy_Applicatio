<?php


namespace App\Http\Controllers;
use Validator;
use App\Traits\Image;
use App\Traits\notification_database;
use App\Http\Requests\Products\{
    requestProduct,
    requestUpdateProduct
};
use App\Models\Product;
use Illuminate\Support\Facades\DB;


class ProductController extends BaseController
{
    use Image,notification_database;


    public function index(){
        $product=Product::with(['photos','user'])->get();
        return $this->sendResponse($product,'done');
    }


    public function store(requestProduct $request)
    {

        $product=Product::create($request->all());

      foreach ($request->file('images') as $image) {
            $photoPath = $this->storeImage($image,$product,'/images/product_photo/');
        }
        $this->send_notification($product);
        return $this->sendResponse($product,'product create successfully, please wait to accept it by admin.');
    }


    public function show(string $id)
    {
        $product=Product::find($id)->with(['photos','user'])->get();
        if($product){

            return $this->sendResponse($product,'done');
        }
        return $this->sendError('','Invalid',500);
    }




     public function Update(requestUpdateProduct $request,$id){
        $product=Product::find($id);

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


    public function destroy(string $id)
    {
        $product=Product::find($id);
        if(!$product){
            return $this->sendError('','product not found');
        }
        else{
          return  DB::transaction(function () use ($product) {
                $product->delete();
                return $this->sendResponse('','Product deleted successfully');
            });

        }
    }
}
