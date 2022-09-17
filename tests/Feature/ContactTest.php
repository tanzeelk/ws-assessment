<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Contact;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use App\Events\InquiryCreated;
use App\Notifications\InquiryMail;
use App\Listeners\SendInquiryNotification;

class ContactTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private $contact;

    public function setUp(): void{
        parent::setUp();
        $this->contact = $this->createContact();
    }

    public function test_store_contact()
    {
        $response = $this->post(route('contact.store', $this->contact));
        
        $this->assertCount(1, Contact::all());
        $this->assertDatabaseHas('inquiries', ['name' => $this->contact->name]);
        $response->assertRedirect();
    }

    public function test_name_max_length_50_while_storing_contact()
    {
        $response = $this->post(route('contact.store', [
            'name' => str_repeat('a', 51),
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'message' => $this->faker->sentence
        ]));

        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'name' => 'The name must not be greater than 50 characters.'
        ]); 
        $response->assertRedirect(); 
    }

    public function test_email_max_length_50_while_storing_contact()
    {
        $response = $this->post(route('contact.store', [
            'name' => $this->faker->name,
            'email' => str_repeat('a', 51).'@abc.com',
            'phone' => $this->faker->phoneNumber,
            'message' => $this->faker->sentence
        ]));
        
        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'email' => 'The email must not be greater than 50 characters.'
        ]); 
        $response->assertRedirect(); 
    }

    public function test_email_format_while_storing_contact()
    {
        $response = $this->post(route('contact.store', [
            'name' => $this->faker->name,
            'email' => str_repeat('a', 50),
            'phone' => $this->faker->phoneNumber,
            'message' => $this->faker->sentence
        ]));

        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'email' => 'The email must be a valid email address.'
        ]); 
        $response->assertRedirect(); 
    }

    public function test_message_max_length_500_while_storing_contact()
    {
        $response = $this->post(route('contact.store', [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'message' => str_repeat('a', 501)
        ]));

        $response->assertStatus(302);
        $response->assertSessionHasErrors([
            'message' => 'The message must not be greater than 500 characters.'
        ]); 
        $response->assertRedirect(); 
    }

    public function test_all_fields_required_while_storing_contact()
    {
        $response = $this->post(route('contact.store', [
            'name' => '',
            'email' => '',
            'phone' => '',
            'message' => ''
        ]));

        $response->assertSessionHasErrors([
            'name' => 'The name field is required.'
        ]); 

        $response->assertSessionHasErrors([
            'email' => 'The email field is required.'
        ]); 

        $response->assertSessionHasErrors([
            'phone' => 'The phone field is required.'
        ]); 

        $response->assertSessionHasErrors([
            'message' => 'The message field is required.'
        ]); 

        $response->assertStatus(302);
        $response->assertRedirect(); 
    }

    public function test_event_dispatched_after_storing_contact()
    {
        Event::fake([
            InquiryCreated::class
        ]);

        $response = $this->post(route('contact.store', [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'message' => $this->faker->sentence
        ]));
        
        Event::assertDispatched(InquiryCreated::class);
    }

    public function test_notification_sent_after_storing_contact()
    {
        Event::fake([
            InquiryCreated::class
        ]);

        $response = $this->post(route('contact.store', [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'phone' => $this->faker->phoneNumber,
            'message' => $this->faker->sentence
        ]));
        
        Event::assertDispatched(InquiryCreated::class);
    }
}
