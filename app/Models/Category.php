<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{


    use HasFactory;
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
            return $this->hasMany(Product::class);
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
                return $this->hasMany(Category::class)->with(['photos','products']);
            }


}
