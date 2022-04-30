<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CommonMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($m)
    {
        $this->message = $m;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');
        return $this->from('info@roughlang.com')
                    ->subject( "お知らせ" )
                    ->view('mails.test')
                    ->with([
                        'user_name' => 'テスト 太郎' ,
                        'my_text'   => $this->message ,
                    ]);
    }
}
