<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Registration Mail class
 *
 * @author    Vikram Mevasiya
 * @copyright 2020 Crenspire Technologies (http://www.crenspire.com)
 */
class RegistrationEmail extends Mailable
{
    use SerializesModels;

    public $data;

    public function __construct($data) {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       return $this->to($this->data['email'])
                ->from(config('mail.from.address'))
                ->subject('Welcome to ReadiWork')
                ->view('emails.user.registration')->with('data', $this->data);
    }
}
