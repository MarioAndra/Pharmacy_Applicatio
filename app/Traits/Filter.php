<?php
namespace App\Traits;
use App\Models\Product;
trait Filter
{
    public function scopeFilter($query, array $filters)
    {

        $filterable = ['created_at', 'name', 'products_number','price',];

        foreach ($filterable as $filter) {
            if (isset($filters[$filter])) {
                if ($filter == 'products_number') {
                    $query->withCount('products')->orderBy('products_count', $filters[$filter]);

                } else {
                    $query->orderBy($filter, $filters[$filter]);
                }
            }
        }
        return $query;
    }






    public function filter_category_product_count($query,array $filters){
        $query->joinSub(
            Product::select('category_id')
                   ->selectRaw('count(*) as products_count')
                   ->groupBy('category_id'),
            'product_counts',
            function ($join) {
                $join->on('products.category_id', '=', 'product_counts.category_id');
            }
        )->orderBy('products_count', $filters['category_product_count']);
    }



    public function filter_category_name($query,$filters){
        $query->join('categories', 'products.category_id', '=', 'categories.id')
        ->orderBy('categories.name', $filters['category_name']);
    }
}
