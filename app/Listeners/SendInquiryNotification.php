<?php

namespace App\Listeners;

use App\Events\InquiryCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\InquiryMail;
use Illuminate\Support\Facades\Log;

class SendInquiryNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\InquiryCreated  $event
     * @return void
     */
    public function handle(InquiryCreated $event)
    {
        try {

            Notification::route('mail', [
                'devtest@worksite.ca' => 'Dev Test',
            ])->notify(new InquiryMail($event->contact));

        } catch (Exception $exception) {
            Log::error($exception);
        }
        
    }
}
