<?php

namespace App\Mail;

use App\Enums\SourceType;
use App\Models\Material;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PeriodicDigest extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(public string $period = 'monthly')
    {}

    public function envelope(): Envelope
    {
        $subject = str('Larasense - ')->append($this->period, ' Digest')->headline();

        return new Envelope(
            subject: $subject,
        );
    }

    public function content(): Content
    {

        return new Content(
            view: 'emails.periodic-digest.index',
            with: [
                'youtubeMaterials' => Material::feedQuery()->sourceType(SourceType::Youtube)->trending($this->period)->take(5)->get(),
                'articleMaterials' => Material::feedQuery()->sourceType(SourceType::Article)->trending($this->period)->take(5)->get(),
                'podcastMaterials' => Material::feedQuery()->sourceType(SourceType::Podcast)->trending($this->period)->take(5)->get(),
            ]
        );
    }
}
