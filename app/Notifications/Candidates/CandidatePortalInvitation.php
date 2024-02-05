<?php

namespace App\Notifications\Candidates;

use App\Models\Candidates;
use App\Settings\GeneralSetting;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class CandidatePortalInvitation extends Notification implements ShouldQueue
{
    use Queueable;

    private Model|array|null $candidate;

    private string $companyName;

    private string $signup_link;

    /**
     * Create a new notification instance.
     */
    public function __construct(Candidates $candidates, $inviteLink = null)
    {
        $this->candidate = $candidates;
        $this->companyName = (new GeneralSetting)->company_name;
        $this->signup_link = $inviteLink;
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
            ->subject('Invitation to Join Our Portal - Unlock Exciting Opportunities!')
            ->greeting("Dear {$this->candidate->LastName},")
            ->from(env('MAIL_FROM_ADDRESS'), $this->companyName)
            ->line('We hope this email finds you well. We are thrilled to extend an exclusive invitation to you to join our dedicated candidate portal, where a world of exciting opportunities and possibilities awaits.')
            ->line("At {$this->companyName}, we value the unique skills, experiences, and potential that each candidate brings to the table. Your application and interview process have left a lasting impression on us, and we believe that you have the qualities that align perfectly with our mission and values.")
            ->line("Here's what you can expect by joining our portal:")
            ->with(new HtmlString("1. <strong>Tailored Job Opportunities</strong>: Our portal will provide you with a personalized job-matching experience. You'll receive job recommendations that align with your skills, experience, and career aspirations."))
            ->with(new HtmlString("2. <strong>Application Tracking</strong>: Easily keep track of your application status, interview updates, and hiring progress for positions you've applied to within our organization."))
            ->with(new HtmlString("3. <strong>Company Insights</strong>: Gain a deeper understanding of our culture, values, and the teams you'll potentially be a part of. Get a behind-the-scenes look at what it's like to work at {$this->companyName}."))
            ->with(new HtmlString('4. <strong>Community Engagement</strong>: Connect with fellow candidates, employees, and industry professionals through discussion forums, networking events, and knowledge-sharing opportunities.'))
            ->line('To get started, simply click on the link below to create your portal account:')
            ->action('Sign Up', $this->signup_link)
            ->line('Please use the same email address that you used during your application process to ensure seamless access to your candidate profile.')
            ->line("We are excited to have you as a part of our talent community and to explore the possibilities of you joining our {$this->companyName} family.")
            ->line("Thank you for considering this invitation. We believe that great opportunities begin with great talent, and you're a testament to that belief.")
            ->line('We look forward to seeing you on our portal and, hopefully, as a part of our dynamic team.')
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
