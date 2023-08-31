<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use HubSpot\Factory;
use HubSpot\Client\Crm\Objects\Notes\ApiException;
use HubSpot\Client\Crm\Objects\Notes\Model\AssociationSpec;
use HubSpot\Client\Crm\Objects\Notes\Model\PublicAssociationsForObject;
use HubSpot\Client\Crm\Objects\Notes\Model\PublicObjectId;
use HubSpot\Client\Crm\Objects\Notes\Model\SimplePublicObjectInputForCreate;

class HubSpotEngagementController extends Controller
{
    public function createEngagement(Request $request)
    {
        $accessToken = env('HUBSPOT_API_KEY'); // Replace with your access token

        $client = Factory::createWithAccessToken($accessToken);

        $properties = [
            'hs_timestamp' => '2019-10-30T03:30:17.883Z',
            'hs_note_body' => 'Spoke with decision maker john',
            'hubspot_owner_id' => '513323221'
        ];
        $to = new PublicObjectId([
            'id' => '8753139687'
        ]);
        $associationSpec = new AssociationSpec([
            'association_category' => 'HUBSPOT_DEFINED',
            'association_type_id' => 12
        ]);
        $publicAssociationsForObject = new PublicAssociationsForObject([
            'to' => $to,
            'types' => [$associationSpec]
        ]);
        $simplePublicObjectInputForCreate = new SimplePublicObjectInputForCreate([
            'properties' => $properties,
            'associations' => [$publicAssociationsForObject],
        ]);

        try {
            $apiResponse = $client->crm()->objects()->notes()->basicApi()->create($simplePublicObjectInputForCreate);
            return response()->json($apiResponse);
        } catch (ApiException $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }}
}
