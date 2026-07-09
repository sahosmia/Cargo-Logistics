<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ContactController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the contacts.
     */
    public function index()
    {
        $this->authorize('viewAny', Contact::class);

        $contacts = Contact::latest()->paginate(settings('paginated_quantity', 10));

        return Inertia::render('Admin/Contacts/Index', [
            'contacts' => $contacts
        ]);
    }
}
