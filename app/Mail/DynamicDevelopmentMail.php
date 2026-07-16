<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DynamicDevelopmentMail extends Mailable
{
    use Queueable, SerializesModels;

    // Define dynamic properties explicitly to safely pass into object instances 
    public array $payloadData;

    public function __construct(array $payloadData)
    {
        $this->payloadData = $payloadData;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Dynamic Data: ' . ($this->payloadData['title'] ?? 'Default Mail System'),
        );
    }

    public function content(): Content
    {
        return new Content(
            htmlString: "
                <h3>Account Activity Update</h3>
                <p><strong>User Node Name:</strong> " . e($this->payloadData['username']) . "</p>
                <p><strong>Environment Status:</strong> " . e($this->payloadData['status']) . "</p>
            ",
        );
    }
}