<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Twilio\TwiML\VoiceResponse;
use App\Models\Call;

class CallController extends Controller
{
    public function initiateCall(Request $request)
    {
        $sid    = env('TWILIO_SID');
        $token  = env('TWILIO_AUTH_TOKEN');
        $twilio = new Client($sid, $token);

        $call = $twilio->calls->create(
            $request->input('phone_number'), // to
            env('TWILIO_PHONE_NUMBER'), // from
            [
                "record" => true,
                "url" => route('twilio.webhook')
            ]
        );

        // Store call SID in the database
        Call::create([
            'call_sid' => $call->sid,
            'phone_number' => $request->input('phone_number')
        ]);

        return response()->json(['message' => 'Call initiated successfully!']);
    }

    public function handleWebhook(Request $request)
    {
        $callSid = $request->input('CallSid');
        $recordingUrl = $request->input('RecordingUrl');

        $call = Call::where('call_sid', $callSid)->first();
        if ($call) {
            $call->recording_url = $recordingUrl;
            $call->save();
        }

        $response = new VoiceResponse();

        // Respond with a simple message
        $response->say('Hello, this is your Twilio webhook response.');

        // Optionally, you can redirect to another endpoint for further handling
        // $response->redirect(url('/your-next-endpoint'));

        return response($response, 200)->header('Content-Type', 'text/xml');
    }

    public function repeatRecording(Request $request)
    {
        $response = new VoiceResponse();

        // Retrieve the recording URL from the query parameters
        $recordingUrl = $request->query('RecordingUrl');

        // Play back the recording
        if ($recordingUrl) {
            $response->play($recordingUrl);
        } else {
            $response->say('Recording URL not provided.');
        }

        return response($response, 200)->header('Content-Type', 'text/xml');
    }
}
