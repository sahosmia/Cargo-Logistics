<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactMail;
use App\Models\Contact;
use Illuminate\Support\Facades\Mail;

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

        $adminEmail = settings('email') ?? config('mail.from.address');

        Mail::to($adminEmail)->send(new ContactMail(
            $validated['name'],
            $validated['email'],
            $validated['message']
        ));

        return back()->with('success', 'Thank you for contacting us! We will get back to you soon.');
    }
}
