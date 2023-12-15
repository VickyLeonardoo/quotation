<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApprovalMailInv extends Mailable
{
    public $inv;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($inv)
    {
        $this->inv = $inv;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('admin@example.com')
                    ->subject('Approval Invoice')
                    ->view('email.approvalMailInv');
    }
}

