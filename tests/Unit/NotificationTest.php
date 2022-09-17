<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Contact;
use Illuminate\Support\Facades\Notification;
use App\Events\InquiryCreated;
use App\Notifications\InquiryMail;
use App\Listeners\SendInquiryNotification;

class NotificationTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_notification_sent_after_storing_contact()
    {
        Notification::fake();

        $contact = Contact::factory()->create();
        $event = new InquiryCreated($contact);
        $listener = new SendInquiryNotification();
        $listener->handle($event);

        Notification::assertSentOnDemand(InquiryMail::class);
        $this->assertTrue(true);
    }
}
