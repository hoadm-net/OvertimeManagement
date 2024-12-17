<?php

namespace App\Mail;

use App\Models\Overtime;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RequestApproved extends Mailable
{
    use Queueable, SerializesModels;

    public $overtime;
    /**
     * Create a new message instance.
     */
    public function __construct(Overtime $overtime)
    {
        //
        $this->afterCommit();
        $this->overtime = $overtime;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your request has been approved',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        $status = "Has been declined";
        $style = 'color: #888888; text-decoration: line-through';

        if ($this->overtime->status == 'manager_approved') {
            $status = "The manager has approved";
            $style = 'color: #1d4ed8';
        } elseif ($this->overtime->status = 'bod_approved') {
            $status = "The director has approved";
            $style = 'color: #047857';
        }


        return new Content(
            view: 'mail.approval-request',
            with: [
                'Name' => $this->overtime->name,
                'Department'=> $this->overtime->department->name,
                'Shift' => $this->overtime->shift,
                'Start' => date('d-m-Y H:i', strtotime($this->overtime->begin)),
                'End' => date('d-m-Y H:i', strtotime($this->overtime->end)),
                'Description' => $this->overtime->description,
                'Bus' => $this->overtime->bus ? "Yes" : "No",
                'Status' => $status,
                'Style' => $style,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
