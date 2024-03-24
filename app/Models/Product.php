<?php

namespace App\Models;
use App\Scopes\price;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Traits\Image;
use App\Traits\Filter;
use Illuminate\Support\Facades\Storage;
class Product extends Model
{

    use HasFactory,Image,Filter;
    protected $fillable = [
        'name',
        'price',
        'category_id',
        'user_id',
        'status',
    ];

    public function toArray()
    {
        $array = parent::toArray();
        $array['created_at'] = $this->getCreatedFromAttribute();

        return $array;
    }

    public function category()
    {
        return $this->BelongsTo(Category::class,'category_id');
    }

    public function user(){

        return $this->BelongsTo(User::class);
    }

    public function getCreatedFromAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans(null,true);
    }

    public function photos(){
        return $this->morphMany(Photo::class,'photoable');
    }



    protected static function booted(): void
    {
        static::addGlobalScope(new price);
    }

    public function scopeStartsWithA($query)
    {
        return $query->whereHas('user', function ($q) {
            $q->where('name', 'like', 'a%');
        });
    }


    public function scopeFilters($query, array $filters)
{
    if (isset($filters['category_name'])) {
       $this->filter_category_name($query,$filters);
    }

    if (isset($filters['category_product_count'])) {
         $this->filter_category_product_count($query,$filters);

    }

    return $query;
}








public function scopeStatus($query, $status)
{
    if (in_array($status, ['accepted', 'rejected','prepering'])) {
        return $query->where('status', $status);
    }

    return $query;
}

}
