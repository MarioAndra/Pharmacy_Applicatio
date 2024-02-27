<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{


    use HasFactory;
    protected $fillable = [
        'rcs',
     ];

     public function photoable(){
        return $this->morphTo();
     }

     public function toArray()
     {

         return ['rcs' => $this->rcs];
     }





     public function getCreatedFromAttribute()
     {
         return Carbon::parse($this->created_at)->diffForHumans(null,true);

     }
     protected static function booted()
    {
        parent::boot();

            static::retrieved(function ($photo) {
                $photo->rcs = asset($photo->rcs);
            });
    }

}
