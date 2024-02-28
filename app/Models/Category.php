<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Image;
use Illuminate\Support\Facades\Storage;
class Category extends Model
{


    use HasFactory,Image;
    protected $fillable = [
        'name_category',
        'parent_id',

    ];

    public function toArray()
    {
        $array = parent::toArray();
        $array['created_at'] = $this->getCreatedFromAttribute();

        return $array;
    }

    public function products()
        {
            return $this->hasMany(Product::class,'category_id')->with('user');
        }


        public function getCreatedFromAttribute()
        {
            return Carbon::parse($this->created_at)->diffForHumans(null,true);
        }

        public function photos(){
            return $this->morphMany(Photo::class,'photoable');
        }

        public function parentCategory()
            {
                return $this->belongsTo(Category::class);
            }

        public function subCategories()
            {
                return $this->hasMany(Category::class,'parent_id');
            }

            protected static function booted() {
                static::deleting(function ($category) {
                    if (! $category->subCategories->isEmpty()) {
                        foreach ($category->subCategories as $child) {
                            $child->delete();
                        }
                    }
                });
            }

            public static function boot()
            {
            parent::boot();

            static::deleting(function($category) {
                foreach($category->photos as $photo) {
                    $photoPath = public_path('images/category_photo/' . $photo->filename);

                    if (file_exists($photoPath) && !is_dir($photoPath)) {
                        Storage::delete($photoPath);
                    }
                    $photo->delete();
                }
        });



        }


}
