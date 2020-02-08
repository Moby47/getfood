<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VenOrders extends Mailable
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
         //retrievemailata from session
         $cusMail = session('customerMail');
 
        return $this->from($cusMail,'GETFOODS')
         ->subject('New order on GETFOODS')
         ->markdown('email.vendorOrderMarkdown');
       //  ->with('cusMail',$cusMail);
    }
}
