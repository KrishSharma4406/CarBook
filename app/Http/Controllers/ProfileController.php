<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Car;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:profile.view')->only([
            'index',
        ]);

        $this->middleware('permission:profile.edit')->only([
            'edit',
            'update',
        ]);

        $this->middleware('permission:profile.delete')->only([
            'destroy',
        ]);
    }

    /**
     * Display the user's profile.
     */
    public function index()
    {
        $user = Auth::user();
        $cars = Car::where('user_id', $user->id)->get();

        return view('frontend.cars.index', compact('user', 'cars'));
    }

    /**
     * Edit profile.
     */
    public function edit(Request $request)
    {
        $user = $request->user()->load('cars');

        return view('profile.edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the user's profile.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        $user->fill($request->safe()->except('profile_image'));

        $user->phone = $request->phone;

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        // Upload profile image
        if ($request->hasFile('profile_image')) {
            if ($user->profile_image) {
                $oldPath = public_path('uploads/profileimages/' . basename($user->profile_image));

                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }

                if (Storage::disk('public')->exists($user->profile_image)) {
                    Storage::disk('public')->delete($user->profile_image);
                }
            }

            $imageName = time() . '.' . $request->profile_image->extension();
            $request->profile_image->move(public_path('uploads/profileimages'), $imageName);
            $user->profile_image = $imageName;
        }

        $user->save();

        return redirect()
            ->back()
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
