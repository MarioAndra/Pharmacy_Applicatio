<?php
namespace App\Traits;
use App\Models\Product;
use App\Traits\notification_Mail;
use App\Http\Controllers\BaseController;
trait Products
{
    use notification_Mail;
    public function Status_product($product,$status,$admin){
        $product->update(['status'=>$status]);
        $this->send_notify($product,$admin,$status);
    }

}
