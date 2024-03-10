<?php
namespace App\Traits;
use App\Models\User;
use App\Notifications\statues_product;
use Illuminate\Support\Facades\Notification;
trait notification_Mail{
    public function send_notify($product,$admin,$statues){
        $user=$product->user;
        $user->notify(new statues_product("The product: $product->name $statues by $admin"));

    }
}
