<?php


namespace App\Http\Controllers;
use Validator;
use App\Http\Requests\requestProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Photo;

class ProductController extends BaseController
{

    public function index(){
        $product=Product::where('price','>=','150')->with('category')
        ->with('photos')
        ->get()->all();
        return $this->sendResponse($product,'done');
    }


    public function store(requestProduct $request)
    {
        $product=Product::create($request->all());

                foreach ($request->file('images') as $image) {
                    $filename = time().'.'.$image->getClientOriginalName();
                    $image->move(public_path('images'), $filename);
                    $photo = new Photo;
                    $photo->rcs = '/images/'.$filename;
                    $product->photos()->save($photo);
                }

             return $this->sendResponse($product,'product create successfully');
    }


    public function show(string $id)
    {
        $product=Product::find($id)->with('category')
        ->with('photos')->with('user')->where('price','>=','150')
        ->get()->all();
        return $this->sendResponse($product,'Done');
    }




     public function Update(requestProduct $request,$id){
        $product=Product::find($id);

        if($product){

          $product->update($request->all());

            foreach ($request->file('images') as $newImage) {
                $filename = time().'.'.$newImage->getClientOriginalName();
                $newImage->move(public_path('images'), $filename);
                $product->photos()->update(['rcs'=>$filename]);
                $product->save();

            }

            return $this->sendResponse($product,'Product updated successfully');
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
        $product->photos()->delete();
        $product->delete();
        return $this->sendResponse('','Product deleted successfully');
        }
    }
}
