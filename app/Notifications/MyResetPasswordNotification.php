<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MyResetPasswordNotification extends ResetPassword
{

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Voce Esta recebendo esse email para redefinir a sua senha')
            ->action('Redefinir senha', url(config('app.url').route('password.reset', $this->token, false)));
    }

    
}
