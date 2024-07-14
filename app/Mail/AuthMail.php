<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AuthMail extends Mailable implements ShouldQueue
{
  use Queueable, SerializesModels;

  public $subject, $title, $user_name, $msg, $link;

  /**
  * Create a new message instance.
  */
  public function __construct(string $subject, string $title, string $user_name, string $message, string $link) {
    $this->subject = $subject;
    $this->title = $title;
    $this->user_name = $user_name;
    $this->msg = $message;
    $this->link = $link;
  }

  /**
  * Get the message envelope.
  */
  public function envelope(): Envelope {
    return new Envelope(
      subject: $this->subject,
    );
  }

  /**
  * Get the message content definition.
  */
  public function content(): Content {
    return new Content(
      view: 'mail.auth_mail',
    );
  }

  /**
  * Get the attachments for the message.
  *
  * @return array<int, \Illuminate\Mail\Mailables\Attachment>
  */
  public function attachments(): array {
    return [];
  }
}
