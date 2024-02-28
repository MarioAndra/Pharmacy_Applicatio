<?php

namespace App\Http\Controllers;
use App\Traits\Image;
use App\Http\Requests\requestCategory;
use App\Http\Requests\updateCategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Photo;
use Validator;

class CategoryController extends BaseController
{
    use Image;

    public function index(){
        $category = Category::with(['products' => function ($q) {
            $q->startsWithA();
        }, 'photos','subCategories'])->get();
        return $this->sendResponse($category,'done');
    }


    public function store(requestCategory $request)
    {
        $category=Category::create($request->all());
        $photoPath = $this->storeImage($request->file('image'),$category,'/images/category_photo/');
        return $this->sendResponse($category,'category create successfully');
    }


    public function show(string $id)
    {
        $category = Category::find($id);

        if(!$category){
            return $this->sendError('', 'This category not found');
        }
        else{
            $category = Category::with(['products' => function ($q) {
                $q->startsWithA();
            }, 'photos','subCategories'])->find($id);
        return $this->sendResponse($category, 'Done');
    }


}

    public function Update(updateCategoryRequest $request,$id){
        $category=Category::find($id);
        if($category){
            $category->update($request->all());
            $category->save();
            if($request->hasFile('image')){
                $photoPath=$this->updateImage($request->file('image'),$category,'/images/category_photo/');
        }
        return $this->sendResponse('','Category updated successfully');
    }

    return $this->sendError('','Category not found');
    }




    public function destroy(string $id)
    {
        $category=Category::find($id);
        if(!$category){
            return $this->sendError('','this category not found',500);
        }
        else{
            DB::transaction(function () use ($category) {

               $category->delete();


        });
            return $this->sendResponse('','category deleted successfuly');

        }
    }
}
