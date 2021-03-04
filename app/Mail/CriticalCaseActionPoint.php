<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Criticalcase;

class CriticalCaseActionPoint extends Mailable
{
    use Queueable, SerializesModels;
    protected $critical_case;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Criticalcase $critical_case)
    {
        $this->critical_case = $critical_case;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Critical Case #{$this->critical_case->activity_handling}")
                    ->from('no-reply@pmt.co.id')
                    ->view('emails.critical-case-action-point')
                    ->with(['data'=>$this->critical_case]);
    }
}
