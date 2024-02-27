<?php
namespace App\Traits;
use App\Models\Photo;
trait Image
{
    public function storeImage($file,$user,$path)
    {
        $filename = time().'.'.$file->getClientOriginalName();
        $file->move(public_path($path), $filename);
        $photo = new Photo;
        $photo->rcs = '/images/'.$filename;
        $user->photos()->save($photo);
        return $this->sendResponse($user, 'User created successfully');

    }
    public function updateImage($file,$user,$path){
        $filename=time().'.'.$file->getClientOriginalName();
        $file->move(public_path($path), $filename);
            $photo = $user->photos()->first();
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
