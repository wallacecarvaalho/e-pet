<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class MyResetPasswordNotification extends ResetPassword
{

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Olá')
            ->line('Voce Esta recebendo esse email para redefinir a sua senha')
            ->action('Redefinir senha', url(config('app.url').route('password.reset', $this->token, false)));
    }

    
}
