<?php

namespace App\Notifications\User;

use App\Models\User;
use App\Settings\GeneralSetting;
use Filament\Exceptions\NoDefaultPanelSetException;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class WelcomeSystemUserNotification extends Notification
{
    use Queueable;

    protected ?User $user;

    protected ?string $login_link;

    protected ?string $company_name;

    /**
     * Create a new notification instance.
     *
     * @throws NoDefaultPanelSetException
     */
    public function __construct(?User $user)
    {
        $this->user = $user;
        $this->login_link = filament()->getDefaultPanel()->getLoginUrl();
        $this->company_name = (new GeneralSetting())->company_name;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->from(env('MAIL_FROM_ADDRESS'), $this->company_name)
            ->subject('Welcome to Our System - Verification & Registration Completed')
            ->greeting("Dear {$this->user->name},")
            ->line('We are pleased to inform you that your registration has been successfully completed, and your account is now fully active in our system.')
            ->line('You can now log in with your registered email address and the password you created during the registration process. If you ever forget your password, you can use the "Forgot Password" feature on the login page to reset it.')
            ->action('Login Now!', $this->login_link)
            ->line('If you have any questions or need assistance as you explore the system, please feel free to contact our support team.')
            ->line('Thank you for choosing our system, and we look forward to seeing the positive impact of your contributions.')
            ->salutation(new HtmlString("Regards,<br/>{$this->company_name}"));
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
