<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CusOrders extends Mailable
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
         //$verifytoken = session('verifytoken');
 
        return $this->from('henryonyemaobi@gmail.com','GETFOODS')
         ->subject('Your order on GETFOODS')
         ->markdown('email.CusOrdersMarkdown');
        // ->with('verifytoken',$verifytoken);
    }
}
