<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Concerns\HasAttributes;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Traits\Image;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,Image;



    protected $casts=[
        'password'=>'hashed',
    ];


    protected $fillable = [
       'name',
       'email',
       'number',
    ];




    protected $hidden = [
        'password',

        'remember_token',
    ];

    public function toArray()
    {
        $array = parent::toArray();
        $array['created_at'] = $this->getCreatedFromAttribute();


        return $array;
    }



    public function getCreatedFromAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans(null,true);

    }

    public function products(){

        return $this->hasMany(Product::class,'user_id');

    }

    public function photos(){
        return $this->morphMany(Photo::class,'photoable');
    }

    public static function boot()
    {
    parent::boot();

    static::deleting(function($user) {
        foreach($user->photos as $photo) {
            $photoPath = public_path('/images/user_photo/' . $photo->rcs);
            if(file_exists($photoPath)) {
                unlink($photoPath);
            }
            $photo->delete();
        }
});



}
}
