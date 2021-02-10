<?php

namespace App\Mail;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AskProductQuestion extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    /**
     * @var Product
     */
    public $product;

    /**
     * AskProductQuestion constructor.
     * @param $data
     * @param Product $product
     */
    public function __construct($data, Product $product)
    {
        $this->data = (object)$data;
        $this->product = $product;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->to($this->product->shop->user->email)
            ->cc(config('app.admin_email'))
            ->subject('Product question')
            ->view('mail.product_question');
    }
}
