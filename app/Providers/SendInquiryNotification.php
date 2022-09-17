<?php

namespace App\Providers;

use App\Providers\InquiryCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

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
     * @param  \App\Providers\InquiryCreated  $event
     * @return void
     */
    public function handle(InquiryCreated $event)
    {
        //
    }
}
