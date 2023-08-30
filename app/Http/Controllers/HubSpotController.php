<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class HubSpotController extends Controller
{
    public function createNoteInTicket(Request $request)
    {
        $ticketId = $request->input('ticket_id'); // Ticket ID to which the note will be added
        $noteContent = $request->input('note_content'); // Content of the note

        $apiKey = 'YOUR_HUBSPOT_API_KEY';
        $url = "https://api.hubapi.com/crm-objects/v1/objects/tickets/{$ticketId}/timeline";

        $client = new Client();
        $response = $client->post($url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'objects' => [
                    [
                        'eventTypeId' => 'note',
                        'header' => 'Note Added',
                        'time' => time() * 1000, // Current time in milliseconds
                        'content' => $noteContent,
                    ],
                ],
            ],
        ]);

        $statusCode = $response->getStatusCode();
        $responseData = json_decode($response->getBody(), true);

        if ($statusCode === 200 && isset($responseData['status']) && $responseData['status'] === 'error') {
            return response()->json(['error' => $responseData['message']], 400);
        }

        return response()->json(['message' => 'Note added successfully'], 200);
    }
}
