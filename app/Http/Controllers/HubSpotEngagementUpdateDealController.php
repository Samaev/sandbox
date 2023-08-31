<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use HubSpot\Factory;
use HubSpot\Client\Crm\Deals\ApiException;
use HubSpot\Client\Crm\Deals\Model\SimplePublicObjectInput;

class HubSpotEngagementUpdateDealController extends Controller
{
    public function createNoteInDeal(Request $request)
    {
        $client = Factory::createWithAccessToken(env('HUBSPOT_API_KEY'));

        $properties1 = [
            'dealname' => 'Custom data integrations',
        ];
        $simplePublicObjectInput = new SimplePublicObjectInput([
            'properties' => $properties1,
        ]);
        try {
            $apiResponse = $client->crm()->deals()->basicApi()->update(8753139687, $simplePublicObjectInput);
            echo $apiResponse;
        } catch (ApiException $e) {
            echo "Exception when calling basic_api->update: ", $e->getMessage();
        }
    }
}
