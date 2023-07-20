<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class Assignment_Assigned extends Notification
{
    use Queueable;
    protected $assignment;
    protected $user;

    /**
     * Create a new notification instance.
     */
    public function __construct($user, $assignment)
    {
        $this->user = $user;
        $this->assignment = $assignment;
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
        ->subject('Assignment Assigned')
        ->markdown('emails.assignment_assigned', [
            'user' => $this->user,
            'assignment' => $this->assignment,
        ])
        ->greeting('Hello ' . $notifiable->first_name)
        ->line('You have been assigned a new assignment.')
        ->line('Assignment Name: ' . $this->assignment->name)
        ->line('Company Name: ' . $this->assignment->company_name)
        ->line('Request Type: ' . $this->assignment->request_type)
        ->line('Description: ' . $this->assignment->description)
        ->line('Preffered Start date: ' . $this->assignment->start_date)
        ->action('View Assignment', route('view_assignment', $this->assignment))
        ->line('Thank you for using our system!');
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
