<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Survey extends Mailable
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
         $userId = session('userId');
 
        return $this->from('support@getfoods.ng','GETFOODS')
         ->subject('Vendor survey')
         ->markdown('email.surveyMarkdown')
         ->with('userId',$userId);
    }
}
