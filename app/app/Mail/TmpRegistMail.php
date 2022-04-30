<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TmpRegistMail extends Mailable
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
    return $this->from('info@roughlang.com')
      ->subject($this->mail_message["subject"])
      ->view('mails.tmp_regist')
      ->with([
        'user_name' => $this->mail_message["user_name"],
        'access_url'   => $this->mail_message["access_url"],
      ]);
  }
}
