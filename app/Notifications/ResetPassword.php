<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPassword extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token, $source, $user=false)
    {
        $this->token = $token;
        $this->source = $source;
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if ($this->source == 'api') {
            $link = env('FRONT_URL').'/reset-password/'.$this->token;
        } else {
            $link = url( "/password/reset/".$this->token );
            return (new MailMessage)
            ->view(
                'vendor.mail.reset-password', ['token' => $this->token, 'user' => $this->user]
            )
            ->subject('Reset Password Notification');
        }

        return (new MailMessage)
                    ->subject( 'Reset Password Notification' )
                    ->line( 'You are receiving this email because we received a password reset request for your account.' )
                    ->action( 'Reset Password', $link )
                    ->line( 'Thank you!' );
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
            //
        ];
    }
}