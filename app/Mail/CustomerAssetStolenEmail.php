<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\CustomerAssetManagement;

class CustomerAssetStolenEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $customer_asset;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(CustomerAssetManagement $customer_asset)
    {
        $this->customer_asset = $customer_asset; 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject("Customet Asset Stolen #{$this->customer_asset->tower->name}")
                    ->from('no-reply@pmt.co.id')
                    ->view('emails.customer-asset-stolen')
                    ->with(['data'=>$this->customer_asset]);
    }
}
