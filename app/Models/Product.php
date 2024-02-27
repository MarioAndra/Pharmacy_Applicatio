<?php

namespace App\Models;
use App\Models\Scopes\priceScope;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Product extends Model
{

    protected $with = ['photos:rcs,photoable_id','user'];
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'category_id',
        'user_id',

    ];

    public function toArray()
    {
        $array = parent::toArray();
        $array['created_at'] = $this->getCreatedFromAttribute();

        return $array;
    }

    public function category()
    {
        return $this->BelongsTo(Category::class);
    }

    public function user(){

        return $this->BelongsTo(User::class,'user_id');
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
        static::addGlobalScope(new priceScope);
    }

    public function scopeStartsWithA($query)
    {
        return $query->whereHas('user', function ($q) {
            $q->where('name', 'like', 'a%');
        });
    }




}
