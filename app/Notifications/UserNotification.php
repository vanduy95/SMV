<?php

namespace App\Notifications;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $notify;
    public $fullname;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($notify,$fullname)
    {
        $this->notify=$notify;
        $this->fullname=$fullname;
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
            'notify'=>$this->notify,
            'fullname'=>$this->fullname
        ];
    }
    
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'notify'=>$this->notify,
            'fullname'=>$this->fullname
            ]);
    }
}
