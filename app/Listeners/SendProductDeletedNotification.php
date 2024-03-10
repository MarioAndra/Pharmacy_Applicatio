<?php

namespace App\Listeners;
use App\Traits\notification_Mail;
use App\Notifications\statues_product;
use Illuminate\Support\Facades\Notification;
use App\Events\ProductRejected;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Mail\ProductDeletedMail;
class SendProductDeletedNotification
{
    use notification_Mail;

    public function __construct()
    {

    }


    public function handle(ProductRejected $event): void
    {
        $product = $event->product;
        $this->send_notify($product,'system','deleted');

    }
}

