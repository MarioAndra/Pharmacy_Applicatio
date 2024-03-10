<?php

namespace App\Notifications;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class add_Product extends Notification
{
    use Queueable;

    public $product;
    public function __construct($product)
    {
        $this->product=$product;
    }


    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage);

    }


    public function toArray(object $notifiable): array
    {
        return [
            'product_id'=>$this->product->id,
            'user_id'=>$this->product->user_id,
            'user'=>$this->product->user->name,
            'message'=>'new product is created'
        ];
    }
}
