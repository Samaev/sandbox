<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class HubSpotEngagementController extends Controller
{
    public function createEngagement(Request $request)
    {
        $url = "https://api.hubapi.com/engagements/v1/engagements";

        $querystring = [
            'hapikey' => 'YOUR_HUBSPOT_API_KEY', // Replace with your actual HubSpot API key
        ];

        $payload = [
            "engagement" => [
                "active" => true,
                "ownerId" => 1, // Replace with the ownerId
                "type" => "NOTE",
                "timestamp" => time() * 1000,
            ],
            "associations" => [
                "ticketIds" => [$request->input('ticket_id')], // Replace with the actual ticket ID
            ],
            "metadata" => [
                "body" => $request->input('note_content'),
            ],
        ];

        $client = new Client();
        $response = $client->post($url, [
            'headers' => [
                'Content-Type' => 'application/json',
            ],
            'query' => $querystring,
            'json' => $payload,
        ]);

        $responseBody = json_decode($response->getBody(), true);

        if (isset($responseBody['status']) && $responseBody['status'] === 'error') {
            return response()->json(['error' => $responseBody['message']], 400);
        }

        return response()->json(['message' => 'Note added successfully'], 200);
    }
}
