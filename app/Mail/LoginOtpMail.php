<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoginOtpMail extends Mailable
{
    use Queueable, SerializesModels;

    // 1. Declare variables para magamit sa loob ng email
    public $otp;
    public $username;

    // 2. Tanggapin ang data mula sa Controller
    public function __construct($otp, $username)
    {
        $this->otp = $otp;
        $this->username = $username;
    }

    // 3. Dito ise-set ang Subject at ang mismong Design (HTML)
    public function build()
    {
        return $this->subject('Verification Code: ' . $this->otp)
                    ->html($this->generateHtml());
    }

    // 4. Ito ang magde-design ng parang "Note" card
    private function generateHtml()
    {
        return "
        <div style='font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;'>
            <div style='max-width: 400px; margin: auto; background: white; padding: 30px; border-radius: 10px; border-top: 5px solid #7494ec; box-shadow: 0 4px 10px rgba(0,0,0,0.1);'>
                <h2 style='color: #333; text-align: center;'>Login Verification</h2>
                <p style='color: #555;'>Hello <strong>{$this->username}</strong>,</p>
                <p style='color: #555;'>You requested a verification code to access your account. Please use the code below:</p>
                
                <div style='background: #f9f9f9; border: 1px dashed #7494ec; padding: 20px; text-align: center; margin: 20px 0;'>
                    <span style='font-size: 32px; font-weight: bold; letter-spacing: 5px; color: #7494ec;'>{$this->otp}</span>
                </div>

                <p style='font-size: 12px; color: #888; text-align: center;'>This code will expire in 10 minutes. If you did not request this, please ignore this email.</p>
                <hr style='border: 0; border-top: 1px solid #eee; margin: 20px 0;'>
                <p style='font-size: 11px; color: #aaa; text-align: center;'>&copy; " . date('Y') . " Logistic-Project Team</p>
            </div>
        </div>
        ";
    }
}