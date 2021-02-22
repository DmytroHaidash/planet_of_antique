<?php

namespace App\Mail;

use App\Models\Exhibit;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AskExhibitQuestion extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Request
     */
    public $data;
    /**
     * @var Exhibit
     */
    public $exhibit;

    /**
     * AskExhibitQuestion constructor.
     * @param $data
     * @param Exhibit $exhibit
     */
    public function __construct($data, Exhibit $exhibit)
    {
        $this->data = $data;
        $this->exhibit = $exhibit;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->to($this->exhibit->museum->user->email)
            ->cc(config('app.admin_email'))
            ->subject('Exhibit question')
            ->view('mail.exhibit_question');
    }
}
