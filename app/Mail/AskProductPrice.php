<?php

namespace App\Mail;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AskProductPrice extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Request
     */
    public $data;
    /**
     * @var Product
     */
    public $product;

    /**
     * AskProductPrice constructor.
     * @param $data
     * @param Product $product
     */
    public function __construct($data, Product $product)
    {
        $this->data = $data;
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
            ->subject('Item price request')
            ->view('mail.ask_price');
    }
}
