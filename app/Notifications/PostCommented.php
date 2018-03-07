<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;


class PostCommented extends Notification
{
    use Queueable;

    protected $post_id, $comment_id;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($post_id, $comment_id)
    {
        $this->post_id = $post_id;
        $this->comment_id = $comment_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => 'User ',
            'from_user_name' => Auth::user()->name,
            'post_id' => $this->post_id,
            'from_user_id' => Auth::user()->id,
            'message2' => ' have commented on your ',
            'message3' => 'You have commented on your ',
            'comment_id' => $this->comment_id,
        ];
    }
}
