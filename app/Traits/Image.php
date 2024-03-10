<?php
namespace App\Traits;
use App\Models\Photo;
trait Image
{
    public function storeImage($file,$x,$path)
    {
        $filename = time().'.'.$file->getClientOriginalName();

        $file->move(public_path($path),$filename);
        $photo = new Photo;
        $photo->rcs = $filename;
        $x->photos()->save($photo);
    }
    public function updateImage($file,$x,$path){
        $filename=time().'.'.$file->getClientOriginalName();
        $file->move(public_path($path), $filename);
            $photo = $x->photos()->first();
            if ($photo) {

                $photo->update(['rcs' => $filename]);
                $photo->save();
        }
    }

    public function updateImageProduct($file,$product,$path){
        $filename = time().'.'.$file->getClientOriginalName();
        $file->move(public_path($path), $filename);
        $product->photos()->update(['rcs'=>$filename]);
        $product->save();
    }

    




}
