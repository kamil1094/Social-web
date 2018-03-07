<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;

class Liked extends Notification
{
    use Queueable;

    protected $content;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($content)
    {
        $this->content = $content;
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
        if(is_null($this->content['comment']))
        {
            $post_link = '<a href="' . url('posts/' . $this->content['post']->id) . '"> your post </a>';
            $user_link = '<a href="' . url('users/' . Auth::id()) . '">' . Auth::user()->name . '</a>';

            $message = 'User ' . $user_link . ' like' . $post_link;
        }
        else
        {
            $comment_link = '<a href="' . url('posts/' . $this->content['post']->id . '#comment_' . $this->content['comment']->id) . '"> your comment </a>';
            $user_link = '<a href="' . url('users/' . Auth::id()) . '">' . Auth::user()->name . '</a>';
            $message = 'User ' . $user_link . ' like' . $comment_link;
        }

        return [
            'message' => $message,
            'zn1' => 'ustawiony',
        ];
    }
}
