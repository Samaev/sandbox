<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Symfony\Component\DomCrawler\Crawler;
use Illuminate\Support\Facades\Http;

class WebPageExportController extends Controller
{
    public function export()
    {
        $url = "https://www.carbonchain.com/"; // Replace with the URL of the web page you want to export

        $response = Http::get($url);

        $html = $response->body();

        $crawler = new Crawler($html);

        $data = $crawler->each(function ($node) {
            $rowData = [];

            // Loop through each child node to capture HTML content
            $node->children()->each(function ($childNode) use (&$rowData) {
                $rowData[] = $childNode->outerHtml();
            });

            return $rowData;
        });

        // Generate CSV content
        $csvContent = "";

        // Loop through the extracted data and create CSV rows
        foreach ($data as $row) {
            $csvContent .= implode(',', $row) . "\n";
        }

        // Create a CSV response
        $response = Response::make($csvContent);
        $response->header('Content-Type', 'text/csv');
        $response->header('Content-Disposition', 'attachment; filename="exported_data.csv"');

        return $response;
    }
}





