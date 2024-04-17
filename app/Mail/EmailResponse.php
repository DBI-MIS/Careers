<?php

namespace App\Mail;

use App\Models\Response;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;
use MailerSend\Helpers\Builder\Personalization;
use MailerSend\Helpers\Builder\Variable;
use MailerSend\LaravelDriver\MailerSendTrait;
use Illuminate\Mail\Mailables\Headers;
use Mailtrap\EmailHeader\CategoryHeader;
use Mailtrap\EmailHeader\CustomVariableHeader;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Header\UnstructuredHeader;




class EmailResponse extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels, MailerSendTrait;
    
    /**
     * Create a new message instance.
     */
    
    // public $post_title;
    // public $date_response;
    // public $full_name;    
    // public $contact;
    // public $email_address;
    // public $current_address;
    // public $attachment;
    
    public function __construct(public $response)
    {
        $this->response = $response;
        // $post_title = $this->response->post_title;
        // $full_name = $this->response->full_name;
        // $date_response = $this->response->date_response;
        // $contact = $this->response->contact;
        // $email_address = $this->response->email_address;
        // $attachment = $this->response->attachment;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Job Application',
            // from: new Address('desktoppublisher@dbiphils.com', 'Notification'),
            using: [
                function (Email $email) {
                    // Category (should be only one)
                    $email->getHeaders()
                        ->add(new CategoryHeader('Job Application'))
                    ;
                },
            ]
        );
    }

    /**
     * Get the message content definition.
     * 
     */


    public function content(): Content
    {
        
    
        return new Content(
            view: 'mail.mail',
            // with: [
            //     'post_title' => $this->response->post_title,
            //     'full_name' => $this->response->full_name,
            //     'date_respone' => $this->response->date_response,
            //     'contact' => $this->response->contact,
            //     'email_address' => $this->response->email_address,
            //     'attachment' => $this->response->attachment

            // ],
        );
    }

    
    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromPath('public'),
        ];
    }

    
}

