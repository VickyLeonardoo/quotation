<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApprovalMail extends Mailable
{
    public $qto;
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct($qto)
    {
        $this->qto = $qto;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('admin@example.com')
                    ->subject('Approval Quotattion')
                    ->view('email.approvalMailQto');
    }
}
