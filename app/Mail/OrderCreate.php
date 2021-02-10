<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderCreate extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var \App\Models\Order
     */
    public $order;

    /**
     * OrderCreate constructor.
     * @param Order $order
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->to($this->order->product->shop->user->email)
            ->cc(config('app.admin_email'))
            ->subject('New order')
            ->view('mail.product_order');
    }
}
