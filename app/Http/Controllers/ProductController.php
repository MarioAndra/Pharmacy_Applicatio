<?php

namespace App\Http\Controllers;
use Validator;
use App\Http\Requests\requestCreateProduct;
use App\Http\Requests\requestUpdateProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;




class ProductController extends BaseController
{

        public function createProduct(requestCreateProduct $request){

             $product=Product::create($request->all());
             return $this->sendResponse('','product create successfully');

        }


    public function deleteProduct($id){
        $product=Product::find($id);
        if(!$product){
            return $this->sendError('','product not found');
        }
        else{
        $product->delete();
        return $this->sendResponse('','Product deleted successfully');
        }
    }


    public function updateProduct(requestUpdateProduct $request,$id){
        $product=Product::find($id);

        if($product){

          $product->update($request->all());
          
            $product->save();
            return $this->sendResponse('','Product updated successfully');
    }
        return $this->sendError('','product not found');
}

    public function showProduct(){
        $product=Product::with('category')->with('user')->get()->all();
        return $this->sendResponse($product,'Done');
    }

}



