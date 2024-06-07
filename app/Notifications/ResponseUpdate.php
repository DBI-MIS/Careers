<?php

namespace App\Notifications;

use App\Mail\EmailResponse;
use App\Models\Post;
use App\Models\Response;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
// use App\Models\Response;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Arr;


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
    // public $post_title == Post::find($post_title);

    public function __construct($response)
    {
        $this->response = $response;
    
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
        
        $response = $this->response;
        $attachment = $this->response->attachment;
        $post = Post::find($response->post_title)->title;
        

        
            
        
        return (new EmailResponse($response, $attachment, $post))
            ->view('mail.mail')->with('response', $this->response)->with('post', $post)
            ->to('desktoppublisher@dbiphils.com')
            ->subject('New Job Application')
            ->from('ggcmis@dbiphils.com', 'New Job Application ')
            // ->replyTo($this->response->email, $this->response->full_name, 'replyTo')
                
            
            
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
