<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Contact;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function submit(ContactRequest $request)
    {
        $validated = $request->validated();

        try {
            Contact::create($validated);

            return back()->with('success', 'Thank you for contacting us! We will get back to you soon.');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'An error occurred while sending your message. Please try again later.')
                ->withInput();
        }
    }
}
