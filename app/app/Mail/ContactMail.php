<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mail_message)
    {
      $this->mail_message = $mail_message;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      return $this->from('info@roughlang.com') // app.configから取得したい
      ->subject($this->mail_message["subject"])
      ->view('mails.contact')
      ->with([
        'subject' => $this->mail_message["subject"],
        'name' => $this->mail_message["name"],
        'email'   => $this->mail_message["email"],
        'inquiry_text'   => $this->mail_message["inquiry_text"],
        'category'   => $this->mail_message["category"],
      ]);
    }
}
