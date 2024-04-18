<?php

namespace App\Notifications;

use App\Mail\EmailResponse;
use App\Models\Response;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
// use App\Models\Response;
use Illuminate\Notifications\Notifiable;

class ResponseUpdate extends Notification
{
    use Queueable;
    use Notifiable;
    
    public $response;
    
    // public  $post_title;
    // public  $date_response;
    // public ?string $full_name;    
    // public ?string $contact;
    // public ?string $email_address;
    // public ?string $current_address;

    // public $attachment;
    /**
     * Create a new notification instance.
     */
    public function __construct($response)
    {
        $this->response = $response;
        // dd($message);
        // $this->post_title = $post_title;
        // $this->full_name;
        // $this->date_response;
        // $this->contact;
        // $this->email_address;
        // $this->attachment;
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
    public function toMail(object $notifiable): Mailable
    {
        // $url = url('/job/'.$this->response>id);
        // return (new MailMessage)
        //             ->from('desktoppublisher@dbiphils.com', 'Notification')
        //             ->line('The introduction to the notification.')
        //             ->action('Notification Action', url('/'))
        //             ->line('Thank you for using our application!');
        // dd($notifiable);

        // $post_title = $notifiable->post_title;
        // $full_name = $notifiable->full_name;
        // $date_respone = $notifiable->date_response;
        // $contact = $notifiable->contact;
        // $email_address = $notifiable->email_address;
        // $attachment = url($notifiable->attachment);
        $response = $this->response;
        $attachment = $this->response->attachment;
        

        // return (new MailMessage())
        //             ->subject('New Job Application')
        //             ->from('desktoppublisher@dbiphils.com', 'New Job Application ')
        //             ->line('You have a new Job Application')
        //             ->action('View Response', url('/admin/responses'))
        //             ->line('Thank you!');
        
        
        return (new EmailResponse($response, $attachment))
            ->view('mail.mail')->with('response', $this->response)
            ->to('desktoppublisher@dbiphils.com')
            ->subject('New Job Application')
            ->from('desktoppublisher@dbiphils.com', 'New Job Application ')
                
            
            
            ;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            Attachment::fromPath('public'.$this->response->attachment),
        ];
    }
}
