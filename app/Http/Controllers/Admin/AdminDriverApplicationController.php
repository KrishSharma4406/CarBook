<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DriverApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AdminDriverApplicationController extends Controller
{
    /**
     * Display a listing of driver applications.
     */
    public function index(Request $request)
    {
        $query = DriverApplication::with(['user', 'messages'])->latest();

        // Status Filter
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        // Search Filter
        if ($request->filled('search')) {
            $search = trim($request->search);
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%")
                  ->orWhere('vehicle_number', 'like', "%{$search}%")
                  ->orWhere('vehicle_make_model', 'like', "%{$search}%");
            });
        }

        $applications = $query->paginate(15)->withQueryString();

        // Metrics for summary cards
        $metrics = [
            'total'     => DriverApplication::count(),
            'pending'   => DriverApplication::where('status', 'pending')->count(),
            'contacted' => DriverApplication::where('status', 'contacted')->count(),
            'approved'  => DriverApplication::where('status', 'approved')->count(),
            'rejected'  => DriverApplication::where('status', 'rejected')->count(),
        ];

        return view('admin.driver-applications.index', compact('applications', 'metrics'));
    }

    /**
     * Display the specified driver application details.
     */
    public function show(DriverApplication $driverApplication)
    {
        $driverApplication->load(['user', 'messages.admin', 'messages.user']);

        // Mark incoming driver messages as read
        $driverApplication->messages()
            ->where('sender_type', 'driver')
            ->where('is_read', false)
            ->update(['is_read' => true]);

        // Clean phone number for WhatsApp link (strip non-digit characters)
        $cleanPhone = preg_replace('/[^0-9]/', '', $driverApplication->phone);
        // If phone has 10 digits without country code, default to 91 for India if needed, or leave as cleanPhone
        if (strlen($cleanPhone) === 10) {
            $cleanPhone = '91' . $cleanPhone;
        }

        return view('admin.driver-applications.show', compact('driverApplication', 'cleanPhone'));
    }

    /**
     * Send direct message from admin to the driver.
     */
    public function sendMessage(Request $request, DriverApplication $driverApplication)
    {
        $request->validate([
            'message' => 'required|string|max:5000',
        ]);

        $driverApplication->messages()->create([
            'sender_type' => 'admin',
            'admin_id'    => auth('admin')->id(),
            'message'     => $request->message,
            'is_read'     => false,
        ]);

        // Automatically update status to 'contacted' if still pending
        if ($driverApplication->status === 'pending') {
            $driverApplication->status = 'contacted';
        }
        if (!$driverApplication->contacted_at) {
            $driverApplication->contacted_at = now();
        }
        $driverApplication->save();

        return redirect()->to(route('driver-applications.show', $driverApplication->id) . '#messages-card')
            ->with('success', 'Message sent to the driver successfully.');
    }

    /**
     * Update application status and admin follow-up notes.
     */
    public function update(Request $request, DriverApplication $driverApplication)
    {
        $request->validate([
            'status'      => 'required|in:pending,contacted,approved,rejected',
            'admin_notes' => 'nullable|string|max:5000',
        ]);

        $driverApplication->status = $request->status;
        $driverApplication->admin_notes = $request->admin_notes;

        if ($request->status === 'contacted' && !$driverApplication->contacted_at) {
            $driverApplication->contacted_at = now();
        }

        $driverApplication->save();

        return redirect()->route('driver-applications.show', $driverApplication->id)
            ->with('success', 'Driver application details updated successfully.');
    }

    /**
     * Remove the specified driver application.
     */
    public function destroy(DriverApplication $driverApplication)
    {
        if ($driverApplication->license_document && File::exists(public_path($driverApplication->license_document))) {
            File::delete(public_path($driverApplication->license_document));
        }

        $driverApplication->delete();

        return redirect()->route('driver-applications.index')
            ->with('success', 'Driver application deleted successfully.');
    }
}
