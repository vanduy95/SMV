<?php

namespace App\Notifications;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CreateOrderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    public $name='';
    public $orders;


    public function __construct($name,$orders)
    {
        $this->name=$name;
        $this->orders=$orders;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','broadcast'];
    }

    
     public function toDatabase($notifiable)
    {
        return [
            'name'=>$this->name.' đã gửi 1 đơn hàng',
            'orders'=>$this->orders
        ];
    }
    
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
           'name'=>$this->name.' đã gửi 1 đơn hàng',
           'orders'=>$this->orders
            ]);
    }
}
