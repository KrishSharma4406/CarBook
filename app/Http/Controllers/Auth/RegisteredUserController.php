<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Support\Facades\Mail;
use App\Models\EmailOtp;
use App\Http\Mail\RegisterOtpMail;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }

    public function sendOtp(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8'
        ]);

        $otp = rand(100000, 999999);

        EmailOtp::updateOrCreate(

            ['email' => $request->email],

            [
                'name' => $request->name,
                'password' => Hash::make($request->password),
                'otp' => $otp,
                'expires_at' => now()->addMinutes(5)
            ]

        );

        try {
            Mail::to($request->email)->send(new RegisterOtpMail($otp, $request->email));
            //dd(Mail::to($request->email)->send(new RegisterOtpMail($otp)));
        } catch (\Exception $e) {
            dd($e->getMessage());
        }

        session([
            'register_email' => $request->email
        ]);

        return redirect()->route('verify.otp');
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required'
        ]);

        $email = session('register_email');

        $record = EmailOtp::where('email', $email)
            ->where('otp', $request->otp)
            ->first();

        if (!$record) {
            return back()->with('error', 'Invalid OTP');
        }

        if (now()->gt($record->expires_at)) {
            return back()->with('error', 'OTP Expired');
        }

        $user = User::create([

            'name' => $record->name,
            'email' => $record->email,
            'password' => $record->password

        ]);

        Auth::login($user);

        $record->delete();

        session()->forget('register_email');

        return redirect('/dashboard')
            ->with('success', 'Registration Successful');
    }
}
