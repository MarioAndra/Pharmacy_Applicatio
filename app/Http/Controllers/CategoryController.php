<?php

namespace App\Http\Controllers;
use App\Traits\Image;
use App\Http\Requests\Categories\{
    requestCategory,
    requestUpdateCategory
};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

use Validator;

class CategoryController extends BaseController
{
    use Image;

    public function __construct()
    {
        $this->authorizeResource(Category::class, 'category');
    }

    public function index(Request $request){
        $category = Category::filter($request->all())
        ->get();
        return $this->sendResponse($category,'done');
    }


    public function store(requestCategory $request)
    {
        $category=Category::create($request->all());
        $photoPath = $this->storeImage($request->file('image'),$category,'/images/category_photo/');
        return $this->sendResponse($category,'category create successfully');
    }


    public function show(Category $category)
    {

        if(!$category){
            return $this->sendError('', 'This category not found');
        }
        else{

        return $this->sendResponse($category, 'Done');
    }


}

    public function Update(requestUpdateCategory $request,Category $category){
        if($category){
            $category->update($request->all());
         if($request->hasFile('image')){
            $photoPath=$this->updateImage($request->file('image'),$category,'/images/category_photo/');
        }
        return $this->sendResponse('','Category updated successfully');
    }

    return $this->sendError('','Category not found');
    }




    public function destroy(Category $category)
    {

        if(!$category){
            return $this->sendError('','this category not found',500);
        }
        else{
           return DB::transaction(function () use ($category) {
               $category->photos()->delete();
               $category->delete();
               return $this->sendResponse('','category deleted successfuly');
        });


        }
    }
}
