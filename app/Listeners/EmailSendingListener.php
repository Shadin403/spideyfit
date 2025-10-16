<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Mail\Events\MessageSending;
use Illuminate\Contracts\Queue\ShouldQueue;

class EmailSendingListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(MessageSending $event)
    {
        // সেশন/কুকিতে ফ্ল্যাগ সেট করুন
        session()->put('email_sending', true);
    }
}
