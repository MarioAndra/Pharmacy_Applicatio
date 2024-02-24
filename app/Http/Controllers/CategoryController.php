<?php

namespace App\Http\Controllers;
use App\Http\Requests\requestCategory;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Photo;
use Validator;

class CategoryController extends BaseController
{


    public function store(requestCategory $request)
    {
        $category=Category::create($request->all());
        $image = $request->file('image');
        $filename = time().'.'.$image->getClientOriginalName();
        $image->move(public_path('images'), $filename);
        $photo = new Photo;
        $photo->rcs = '/images/'.$filename;
        $category->photos()->save($photo);
        return $this->sendResponse($category,'category create successfully');
    }


    public function show(string $id)
    {
        $category = Category::find($id);
        if(!$category){
            return $this->sendError('', 'This category not found');
        }
        else{
        $category = Category::with(['products' => function ($query) {
            $query->whereHas('user', function ($query) {
                $query->where('name', 'like', 'a%');
            });
        }, 'photos'])->find($id);
        return $this->sendResponse($category, 'Done');
    }


}

    public function Update(requestCategory $request,$id){
        $category=Category::find($id);
        if($category){
            $category->update($request->all());
            $category->save();
            $image=$request->file('image');
            $filename=time().'.'.$image->getClientOriginalName();
            $image->move(public_path('images'), $filename);
        $photo = $category->photos()->first();
        if ($photo) {
            $photo->update(['rcs' => $filename]);
            $photo->save();
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
            $category->products()->delete();
            $category->photos()->delete();
            $category->delete();
            return $this->sendResponse('','category and its products deleted successfully');

        }
    }
}
