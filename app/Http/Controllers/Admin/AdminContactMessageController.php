<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class AdminContactMessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:contact.view')->only([
            'index',
            'show'
        ]);

        $this->middleware('permission:contact.delete')->only([
            'destroy'
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(10);
        return view('admin.contact.messages.index', compact('messages'));
    }

    /**
     * Display the specified resource.
     */
    public function show(ContactMessage $contactMessage)
    {
        return view('admin.contact.messages.show', compact('contactMessage'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactMessage $contactMessage)
    {
        $contactMessage->delete();

        return redirect()
            ->route('contact-messages.index')
            ->with('success', 'Message deleted successfully.');
    }
}
