<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * @throws GuzzleException
     */
    public function index(): Factory|Application|View|\Illuminate\Contracts\Foundation\Application
    {
        $client = new Client();
        $response = $client->request('GET', 'https://newsapi.org/v2/everything', [
            'query' => [
                'apiKey' => env('NEWS_API_KEY'),
            ]
        ]);

        $newsItems = json_decode($response->getBody(), true);

        // Pass the news data to the view
        return view('technews', ['newsItems' => $newsItems]);
    }
}
