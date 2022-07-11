<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AnalyticWeeklyReport extends Mailable
{
    use Queueable, SerializesModels;

    public $filepath;
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $filepath)
    {
        $this->data = $data;
        $this->filepath = $filepath;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.analysis.weekly-report')
                    ->subject('Virtual Violations Detectors - Analysis Weekly Report')
                    ->attach($this->filepath);
    }
}
