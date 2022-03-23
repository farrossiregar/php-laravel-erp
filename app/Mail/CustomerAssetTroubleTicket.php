<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\TroubleTicket;

class CustomerAssetTroubleTicket extends Mailable
{
    use Queueable, SerializesModels;
    protected $tt;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(TroubleTicket $tt)
    {
        $this->tt = $tt;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Trouble Ticket #{$this->tt->trouble_ticket_number}")
                    ->from('no-reply@pmt.co.id')
                    ->view('emails.customer-asset-trouble-ticket')
                    ->with(['data'=>$this->tt]);
    }
}
