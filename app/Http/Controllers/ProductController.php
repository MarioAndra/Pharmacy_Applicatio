<?php

namespace App\Http\Controllers;
use Validator;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;



class ProductController extends BaseController
{

        public function createProduct(Request $request){
            $validat=Validator::make($request->all(),[
             'name_product'=>'required',
             'price'=>'required',
             'category_id'=>'required',
            ]);
            if($validat->fails()){
             return $this->sendError('',$validat->errors(),500);
            }
            else{

             $product=Product::create($request->all());
             return $this->sendResponse('','product create successfully');
            }

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

    public function updateProduct(Request $request,$id){
        $product=Product::find($id);

        if($product){
        $validat=Validator::make($request->all(),[
            'name_product'=>'required',
            'price'=>'required',
            'category_id'=>'required',
        ]);
        if($validat->fails())
        {
            return $this->sendError('',$validat->errors(),500);
        }
        else{
            $product->name_product=$request->name_product;
            $product->price=$request->price;
            $product->category_id=$request->category_id;
            $product->save();
            return $this->sendResponse('','Product updated successfully');
        }
    }
        return $this->sendError('','product not found');
}




    public function showProduct(){
        $product=Product::with('category')->get()->all();
        return $this->sendResponse($product,'Done');
    }

}



