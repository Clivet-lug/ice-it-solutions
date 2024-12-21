<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use League\Csv\Writer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display contact page with form
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('contact.index');
    }

    /**
     * Show all contact submissions (admin only)
     *
     * @return \Illuminate\View\View
     */
    public function list(Request $request)
    {
        $query = Contact::query();

        // Apply status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Apply date range filter
        if ($request->filled('date_from')) {
            $query->whereDate('created_at', '>=', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->whereDate('created_at', '<=', $request->date_to);
        }

        // Apply search filter
        if ($request->filled('search')) {
            $search = strtolower($request->search);
            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('LOWER(email) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('LOWER(subject) LIKE ?', ["%{$search}%"]);
            });
        }

        // Apply sorting
        $sort = $request->input('sort', 'created_at');
        $direction = $request->input('direction', 'desc');
        $query->orderBy($sort, $direction);

        // Get paginated results with query parameters appended
        $contacts = $query->paginate(10)->appends([
            'status' => $request->status,
            'date_from' => $request->date_from,
            'date_to' => $request->date_to,
            'search' => $request->search,
            'sort' => $sort,
            'direction' => $direction
        ]);

        return view('contact.list', compact('contacts'));
    }


    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string|min:10',
            'subject' => 'nullable|string|max:255'
        ]);

        try {
            // Create new contact entry
            $contact = Contact::create($validated);

            // Send notification email to admin
            $this->sendAdminNotification($contact);

            // Send confirmation email to user
            $this->sendUserConfirmation($contact);

            // Return success response
            return redirect()->back()->with('success', 'Thank you for your message. We will contact you soon!');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Contact form submission error: ' . $e->getMessage());

            // Return error response
            return redirect()->back()
                ->with('error', 'Sorry, there was a problem submitting your message. Please try again.')
                ->withInput();
        }
    }


    public function show()
    {
        return view('contact.show');
    }


    public function update(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'status' => 'required|in:new,read,responded',
            'admin_notes' => 'nullable|string'
        ]);

        $contact->update($validated);

        return redirect()->route('contact.list')
            ->with('success', 'Contact status updated successfully.');
    }


    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('contact.list')
            ->with('success', 'Contact deleted successfully.');
    }


    private function sendAdminNotification(Contact $contact)
    {
        // You'll need to configure your email settings in .env
        Mail::send('emails.admin-notification', ['contact' => $contact], function ($message) {
            $message->to(config('mail.admin_address'))
                ->subject('New Contact Form Submission');
        });
    }


    private function sendUserConfirmation(Contact $contact)
    {
        Mail::send('emails.user-confirmation', ['contact' => $contact], function ($message) use ($contact) {
            $message->to($contact->email)
                ->subject('We received your message');
        });
    }

    public function markAsRead(Contact $contact)
    {
        if ($contact->status === 'new') {
            $contact->update([
                'status' => 'read',
                'admin_notes' => 'Marked as read on ' . now()->format('Y-m-d H:i:s')
            ]);
        }

        return redirect()->back()->with('success', 'Contact marked as read successfully.');
    }

    public function export(Request $request)
    {
        // Create CSV headers
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=contacts-" . Carbon::now()->format('Y-m-d') . ".csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        ];

        // Define the columns for the CSV
        $columns = [
            'ID',
            'Name',
            'Email',
            'Phone',
            'Subject',
            'Message',
            'Status',
            'Admin Notes',
            'Created At',
            'Updated At'
        ];

        // Create the callback to generate CSV content
        $callback = function () use ($columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            // Query all contacts (you can add filters here if needed)
            Contact::chunk(100, function ($contacts) use ($file) {
                foreach ($contacts as $contact) {
                    fputcsv($file, [
                        $contact->id,
                        $contact->name,
                        $contact->email,
                        $contact->phone,
                        $contact->subject,
                        $contact->message,
                        $contact->status,
                        $contact->admin_notes,
                        $contact->created_at->format('Y-m-d H:i:s'),
                        $contact->updated_at->format('Y-m-d H:i:s')
                    ]);
                }
            });

            fclose($file);
        };

        // Return the streamed response
        return Response::stream($callback, 200, $headers);
    }

    public function updateStatus(Request $request, Contact $contact)
    {
        $validated = $request->validate([
            'status' => 'required|in:new,read,responded',
            'admin_notes' => 'nullable|string|max:1000'
        ]);

        $contact->update($validated);

        return redirect()->back()->with('success', 'Contact status updated successfully.');
    }
}
