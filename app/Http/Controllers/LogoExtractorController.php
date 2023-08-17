<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class LogoExtractorController extends Controller
{
    public function extractLogos()
    {
        $urls = [
            "https://www.carbonchain.com/in-the-news#media",
            "https://www.carbonchain.com/case-studies",
        ];
        $outputFolder = public_path('logos');

        foreach ($urls as $url) {
            $client = new Client();
            $response = $client->get($url);
            $html = $response->getBody()->getContents();

            $crawler = new Crawler($html);
            $images = $crawler->filter('img');

            foreach ($images as $image) {
                $imageUrl = $image->getAttribute('src');
                $imageData = $client->get($imageUrl)->getBody()->getContents();

                $imageName = basename(parse_url($imageUrl, PHP_URL_PATH));
                $imagePath = $outputFolder . '/' . $imageName;

                file_put_contents($imagePath, $imageData);
            }
        }

        return "Logos extracted successfully!";
    }
}
