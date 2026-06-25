<?php

namespace App\Http\Mail;

use Illuminate\Mail\Mailable;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class RegisterOtpMail extends Mailable
{
    public $otp;
    public $email;

    public function __construct($otp, $email)
    {
        $this->otp = $otp;
        $this->email = $email;
    }

    public function build()
    {

        $mail = new PHPMailer(true);

        try {

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;

            $mail->Username = env('MAIL_USERNAME');
            $mail->Password = env('MAIL_PASSWORD');

            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom(env('MAIL_FROM_ADDRESS'), 'CarBook');
            $mail->addAddress($this->email);

            $mail->isHTML(true);

            $mail->Subject = 'CarBook Email Verification';

            $mail->Body = view('emails.registerotp', ['otp' => $this->otp]);

            $mail->send();

            // return "OTP Sent Successfully";
            return $this->subject('Email Verification OTP')
                ->view('emails.registerotp');
        } catch (Exception $e) {

            return $mail->ErrorInfo;
        }
        // return $this->subject('Email Verification OTP')
        //             ->view('emails.registerotp');
    }
}
