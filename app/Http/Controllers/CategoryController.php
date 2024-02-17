<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use Validator;

class CategoryController extends BaseController
{
    public function createCategory(Request $request){
        $validat=Validator::make($request->all(),[
         'name_category'=>'required'
        ]);
        if($validat->fails()){
         return $this->sendError('',$validat->errors(),500);
        }
        else{

            $category=Category::create($request->all());
         return $this->sendResponse('','category create successfully');
        }

     }


    public function deletCategory($id){
        $category=Category::find($id);
        if(!$category){
            return $this->sendError('','this category not found',500);
        }
        else{
            $category->products()->delete();
            $category->delete();
            return $this->sendResponse('','category and its products deleted successfully');

        }


    }

    public function showCategory(){
        $category=Category::get()->all();
        return $this->sendResponse($category,'Done');
    }

    public function ShowProductInCategory($id){
        $category=Category::with('products')->find($id);
        if(!$category){
            return $this->sendError('','this category not found');
        }
        else{
        return $this->sendResponse($category,'done');
        }
    }

    public function updateCategory(Request $request,$id){
        $category=Category::find($id);

        if($category){
        $validat=Validator::make($request->all(),[
            'name_category'=>'required'
        ]);
        if($validat->fails())
        {
            return $this->sendError('',$validat->errors(),500);
        }
        else{
            $category->name_category=$request->name_category;
            $category->save();
            return $this->sendResponse('','Product updated successfully');
        }
    }
        return $this->sendError('','product not found');
}

}
