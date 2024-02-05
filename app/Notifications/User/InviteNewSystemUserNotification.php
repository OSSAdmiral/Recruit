<?php

namespace App\Notifications\User;

use App\Models\User;
use App\Settings\GeneralSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class InviteNewSystemUserNotification extends Notification
{
    use Queueable;

    protected User $user;

    protected ?string $verify_link;

    private string $companyName;

    /**
     * Create a new notification instance.
     */
    public function __construct(User|Model $user, $verify_link)
    {
        $this->user = $user;
        $this->verify_link = $verify_link;
        $this->companyName = (new GeneralSetting)->company_name;
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
            ->subject('Welcome to our System - Complete Your Registration')
            ->from(env('MAIL_FROM_ADDRESS'), $this->companyName)
            ->greeting("Dear {$this->user->name},")
            ->line('We are delighted to welcome you to our system! To complete your registration and ensure the security of your account, please follow these simple steps:')
            ->with(new HtmlString("1. <strong>Verify Your Email Address:</strong> Click on the following link to verify your email address: <a href='{$this->verify_link}'>Verify and Create Account</a>"))
            ->with(new HtmlString('2. <strong>Create Your Password:</strong> After email verification, you will be directed to set your password. Your password must meet the following criteria:'))
            ->with(new HtmlString('<ul><li>At least 8 characters</li><li>A combination of uppercase and lowercase letters</li><li>At least one number</li><li>At least one special character</li></ul>'))
            ->with(new HtmlString('3. <strong>Access the System:</strong> Once your password is created, you will have full access to our system using your registered email and the newly created password.'))
            ->action('Verify and Create Account', $this->verify_link)
            ->line('If you encounter any difficulties during the registration process or have any questions, please do not hesitate to reach out to our support team.')
            ->line('Thank you for choosing to be a part of our system. We look forward to having you on board and working together to achieve success.')
            ->salutation(new HtmlString("Regards,<br/>{$this->companyName}"));
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
