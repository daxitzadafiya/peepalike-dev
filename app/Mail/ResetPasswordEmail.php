<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

/**
 * Reset Password Mail class
 *
 * @author    Vikram Mevasiya <vikram@crenspire.com>
 * @copyright 2020 Crenspire Technologies (http://www.crenspire.com)
 */
class ResetPasswordEmail extends Mailable
{
    use SerializesModels;

    public $verificationData;

    public function __construct($verificationData) {
        $this->verificationData = $verificationData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->verificationData['email'])
            ->from(config('mail.from.address'))
            ->subject('Reset Password Mail')
            ->view('emails.user.forget-password')->with('data', $this->verificationData);
    }
}
