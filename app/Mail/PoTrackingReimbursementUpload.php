<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PoTrackingReimbursementUpload extends Mailable
{
    use Queueable, SerializesModels;
    public $potracking;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($potracking)
    {
        $this->potracking = $potracking;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("PO Tracking Reimbursement #{$this->potracking->project_code}/{$this->potracking->project_name}")
                    ->from('no-reply@pmt.co.id')
                    ->view('emails.po-tracking-reimbursement')
                    ->with(['data'=>$this->potracking]);
    }
}
