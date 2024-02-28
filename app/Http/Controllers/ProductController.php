<?php


namespace App\Http\Controllers;
use Validator;
use App\Traits\Image;
use App\Http\Requests\requestProduct;
use App\Http\Requests\updateProductRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Category;
use App\Models\Photo;

class ProductController extends BaseController
{
    use Image;


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

             return $this->sendResponse($product,'product create successfully');
    }


    public function show(string $id)
    {
        $product=Product::with(['photos','user'])->find($id);
        if($product){
            $product->get();
            return $this->sendResponse($product,'done');
        }
        return $this->sendError('','Invalid',500);
    }




     public function Update(updateProductRequest $request,$id){
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
            DB::transaction(function () use ($product) {

                $product->delete();

            });
        return $this->sendResponse('','Product deleted successfully');
        }
    }
}
