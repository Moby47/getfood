<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Verify extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
         //retrieve data from session66
         $verifytoken = session('verifytoken');
 
        return $this->from('henryonyemaobi@gmail.com','GETFOODS')
         ->subject('Account Verification On GETFOODS')
         ->markdown('email.verifyMarkdown')
         ->with('verifytoken',$verifytoken);
    }
}
