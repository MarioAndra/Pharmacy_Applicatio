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
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /*protected $casts=[
        'password'=>'',
        'password_confirm'=>'hashed',
    ];*/


    protected $fillable = [
       'name',
       'email',
       'number',
    ];




    protected $hidden = [
        //'password',
        //'password_confirm',
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





}
