<?php

namespace App\Console\Commands;
use App\Models\Product;
use Illuminate\Console\Command;
use App\Events\ProductRejected;
class deleteRejectedProduct extends Command
{

    protected $signature = 'product:cron';

    protected $description = 'delete product';


    public function __construct(){
        parent::__construct();
    }


    public function handle()
    {
        $products = Product::where('status', 'rejected')->get();

        foreach ($products as $product) {
            $product->delete();
            event(new ProductRejected($product));
        }
    }
}
