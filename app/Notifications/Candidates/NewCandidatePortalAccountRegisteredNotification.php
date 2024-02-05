<?php

namespace App\Notifications\Candidates;

use App\Models\Candidates;
use App\Settings\GeneralSetting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class NewCandidatePortalAccountRegisteredNotification extends Notification
{
    private Model|array|null $candidate;

    private string $candidate_loginLink;

    protected ?string $company_name;

    public function __construct(Candidates $candidates)
    {
        $this->candidate = $candidates;
        $this->candidate_loginLink = filament()->getPanel('candidate')->getLoginUrl();
        $this->company_name = (new GeneralSetting())->company_name;
    }

    /**
     * Get the notification's delivery channels.
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
            ->subject('Your Candidate Portal Account is Ready!')
            ->greeting("Dear {$this->candidate->LastName}")
            ->from(env('MAIL_FROM_ADDRESS'), $this->company_name)
            ->line('We\'re thrilled to inform you that your candidate portal account has been successfully created. Welcome to our platform! This email is to confirm the successful creation of your account using the invitation you received.')
            ->line('Here are a few key details:')
            ->with(new HtmlString('<strong>Candidate Portal Account Information:</strong>'))
            ->with(new HtmlString("<ul><li>Email Address: {$this->candidate->email} </li></ul>"))
            ->line("You can now log in to your account and start exploring the features and opportunities offered by our portal. Here's how:")
            ->with(new HtmlString('<strong>Getting Started:</strong>'))
            ->line("1. Go to our candidate portal login page: {$this->candidate_loginLink}")
            ->line("2. Use the provided email and the password you've created")
            ->line('3. After logging in, you can access your personalized candidate dashboard, see your applied jobs status, and many more.')
            ->with(new HtmlString('<strong>Important Note:</strong>'))
            ->with(new HtmlString('<ul><li>Keep your login credentials safe and do not share them with others.</li></ul>'))
            ->line("If you encounter any issues during the registration or need assistance, don't hesitate to reach out to our support team.")
            ->line("We're excited to have you as part of our candidate community. Explore job listings, update your profile, and make the most of our portal to advance your career.")
            ->line('Thank you for choosing us, and best of luck in your journey!')
            ->salutation(new HtmlString("Regards,<br/>{$this->company_name}"));

    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     */
    public function toArray($notifiable): array
    {
        return [];
    }
}
