<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
class HubSpotEngagementController extends Controller
{
    public function createEngagement(Request $request)
    {
        $url = 'https://api.hubapi.com/engagements/v1/engagements';

        $querystring = [
            'hapikey' => env('HUBSPOT_API_KEY'), // Replace with your actual HubSpot API key
        ];

        $payload = [
            'engagement' => [
                'active' => true,
                'ownerId' => 26493413, // Replace with the ownerId
                'type' => 'NOTE',
                'timestamp' => time() * 1000,
            ],
            'associations' => [
                'dealIds' => 8753139687, // Replace with the actual deal ID
            ],
            'metadata' => [
                'body' => 'note_body',
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
