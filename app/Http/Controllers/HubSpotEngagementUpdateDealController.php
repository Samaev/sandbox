<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class HubSpotEngagementUpdateDealController extends Controller
{
    public function createNoteInDeal(Request $request)
    {
        $ticketId = env('HUBSPOT_DEAL_ID'); // Ticket ID to which the note will be added
        $noteContent = "Content of the note";

        $apiKey = env('HUBSPOT_API_KEY');
        $url = "https://api.hubapi.com/crm-objects/v1/objects/deals/$ticketId";

        $client = new Client();
        $response = $client->get($url, [
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

        return response()->json($responseData, 200);
    }
}