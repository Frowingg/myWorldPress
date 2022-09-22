<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewProductAdminEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $new_product;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($_new_product)
    {
        $this->new_product = $_new_product;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = [
            'new_product' => $this->new_product
        ];

        return $this->view('emails.new-product-admin-email', $data);
    }
}
