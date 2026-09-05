<?php

namespace App\Http\Controllers\UI;

use App\Http\Controllers\Controller;
use App\Models\DriverApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class BecomeDriverController extends Controller
{
    /**
     * Show the become a driver form.
     */
    public function create()
    {
        $user = Auth::user();
        
        // If user is authenticated, check if they have a pending or approved application
        $existingApplication = null;
        if ($user) {
            $existingApplication = DriverApplication::where('user_id', $user->id)
                ->latest()
                ->first();
        }

        return view('frontend.webviews.become-driver', compact('user', 'existingApplication'));
    }

    /**
     * Store a new driver application.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:25',
            'dob' => 'nullable|date|before:-18 years',
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'license_number' => 'required|string|max:100',
            'license_expiry' => 'nullable|date|after:today',
            'experience_years' => 'required|integer|min:0|max:50',
            'vehicle_type' => 'required|string|max:100',
            'vehicle_make_model' => 'required|string|max:255',
            'vehicle_year' => 'nullable|string|max:10',
            'vehicle_number' => 'required|string|max:50',
            'license_document' => 'nullable|file|mimes:jpeg,png,jpg,pdf|max:5120',
            'message' => 'nullable|string|max:1000',
            'agree_terms' => 'required|accepted',
        ], [
            'dob.before' => 'You must be at least 18 years of age to apply as a driver.',
            'license_expiry.after' => 'Your driving license must not be expired.',
            'agree_terms.required' => 'You must agree to the terms and conditions.',
            'agree_terms.accepted' => 'You must agree to the terms and conditions.',
            'license_document.max' => 'The license document size must not exceed 5MB.',
        ]);

        $data = $request->except(['license_document', 'agree_terms', '_token']);
        $data['user_id'] = Auth::id();
        $data['status'] = 'pending';

        if ($request->hasFile('license_document')) {
            $directory = public_path('uploads/driver_applications');
            if (!File::isDirectory($directory)) {
                File::makeDirectory($directory, 0777, true, true);
            }

            $file = $request->file('license_document');
            $filename = 'license_' . time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move($directory, $filename);
            $data['license_document'] = 'uploads/driver_applications/' . $filename;
        }

        DriverApplication::create($data);

        return redirect()->route('become.driver')->with('success', 'Your driver application has been submitted successfully! Our team will contact you soon with next steps.');
    }
}
