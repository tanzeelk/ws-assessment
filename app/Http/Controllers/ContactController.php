<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Http\Requests\StoreContactRequest;
use App\Events\InquiryCreated;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    public function store(StoreContactRequest $request){
        
        try {
            // Inquiry created
            $contact = Contact::create($request->validated());

            // Dispatching an event to send a notification to the admin.
            event(new InquiryCreated($contact));

        } catch(Exception $exception) {

            //Error logged
            Log::error($exception);

            return redirect()->route('contact')
                ->with('message', 'The message was not sent. Please try again.');
        }

        return redirect()->route('contact')
            ->with('message', 'Thank you for your message. It has been sent.');
    }
}
