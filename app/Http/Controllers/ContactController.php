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

        Contact::create($validated);

        return back()->with('success', 'Thank you for contacting us! We will get back to you soon.');
    }
}
