<?php

namespace App\Notifications;

use EnvoiSMS\Laravel\EnvoiSMSChannel;
use EnvoiSMS\Laravel\Messages\EnvoiSMSMessage;
use Illuminate\Notifications\Notification;

class SendOtpNotification extends Notification
{
    public function via($notifiable): array
    {
        return [EnvoiSMSChannel::class];
    }

    public function toEnvoiSMS($notifiable): EnvoiSMSMessage
    {
        return (new EnvoiSMSMessage())
            ->asOtp(brand: 'Home Store', codeLength: 6, expiry: 600);
    }
}
