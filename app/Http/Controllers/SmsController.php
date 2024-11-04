<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;

class SmsController extends Controller
{
    protected $twilio;

    public function __construct()
    {
        $this->twilio = new Client(
            config('services.twilio.sid'),
            config('services.twilio.token')
        );
    }

    public function index()
    {
        // Fetch contacts and SMS history here
        $contacts = []; // Replace with actual contacts fetch
        $smsHistory = []; // Replace with actual SMS history fetch
        
        return view('sms.index', compact('contacts', 'smsHistory'));
    }

    public function send(Request $request)
    {
        $request->validate([
            'phone' => 'required',
            'message' => 'required',
        ]);

        try {
            $message = $this->twilio->messages->create(
                $request->phone,
                [
                    'from' => config('services.twilio.phone_number'),
                    'body' => $request->message,
                ]
            );

            // Save the message to your database here

            return back()->with('success', 'SMS sent successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to send SMS: ' . $e->getMessage());
        }
    }

    public function sendBulk(Request $request)
    {
        $request->validate([
            'contacts' => 'required|array',
            'message' => 'required',
        ]);

        $successCount = 0;
        $failCount = 0;

        foreach ($request->contacts as $contact) {
            try {
                $message = $this->twilio->messages->create(
                    $contact,
                    [
                        'from' => config('services.twilio.phone_number'),
                        'body' => $request->message,
                    ]
                );

                // Save the message to your database here

                $successCount++;
            } catch (\Exception $e) {
                $failCount++;
            }
        }

        return back()->with('success', "Bulk SMS sent. Success: $successCount, Failed: $failCount");
    }
}
