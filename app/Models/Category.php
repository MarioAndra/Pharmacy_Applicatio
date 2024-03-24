<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Image;
use App\Traits\Filter;
use Illuminate\Support\Facades\Storage;
class Category extends Model
{


    use HasFactory,Image,Filter;
    protected $fillable = [
        'name',
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
            return $this->hasMany(Product::class,'category_id')->startsWithA();
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
                return $this->belongsTo(Category::class,'parent_id');
            }

        public function subCategories()
            {
                return $this->hasMany(Category::class,'parent_id')
                ->with(['subCategories','products.user']);
            }


    public function scopeParent(Builder $builder) {
        $builder->whereNull('parent_id');
    }



}
