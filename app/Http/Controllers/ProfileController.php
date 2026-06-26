<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Car;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     */

    public function index(){
        $user = Auth::user();
        $cars = car::where('user_id', $user->id)->get();
        return view("frontend.cars.index", compact("user","cars"));
    }
    public function edit(Request $request): View
    {
        $user = $request->user();

        // Get user's car details

        $cars = $user->car;
        return view('profile.edit', compact('user', 'cars'));
    }

    /**
     * Update the user's profile.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        $user->fill($request->validated());

        // Update phone number
        $user->phone = $request->phone;

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return redirect('/')
    ->with('success', 'Profile updated successfully.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}