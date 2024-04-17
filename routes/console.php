<?php

use App\Mail\EmailResponse;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();
    

Artisan::command('send-test-mailtrap', function () {
    $post_title = 'Title';
    $date_response = 'Date';
    $full_name = 'Name';    
    $contact = 'Contact';
    $email_address = 'Email';
    $attachment = public_path('favicon.ico');
    Mail::mailer('mailtrap')->to('desktoppublisher@dbiphils.com')->send(new EmailResponse($post_title, $date_response, $full_name, $contact, $email_address, $attachment));
    // Also, you can use specific mailer if your default mailer is not "mailtrap" but you want to use it for welcome mails
    // Mail::mailer('mailtrap')->to('testreceiver@gmail.com')->send(new WelcomeMail("Jon"));
})->purpose('Send welcome mail');
Artisan::command('send-test-mail', function () {
    $post_title = 'Title';
    $date_response = 'Date';
    $full_name = 'Name';    
    $contact = 'Contact';
    $email_address = 'Email';
    $attachment = public_path('favicon.ico');
    Mail::to('desktoppublisher@dbiphils.com')->send(new EmailResponse($post_title, $date_response, $full_name, $contact, $email_address, $attachment));
    // Also, you can use specific mailer if your default mailer is not "mailtrap" but you want to use it for welcome mails
    // Mail::mailer('mailtrap')->to('testreceiver@gmail.com')->send(new WelcomeMail("Jon"));
})->purpose('Send welcome mail');