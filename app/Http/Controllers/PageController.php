<?php

namespace App\Http\Controllers;


use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class PageController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function about()
    {
        return view('about');
    }

    public function birotanlex()
    {
        return view('birotanlex');
    }

    public function birotanauen()
    {
        $cacheKey = 'youtube_videos';
        $cacheDuration = 60; // Cache duration in minutes

        // Check if the data is already cached
        if (Cache::has($cacheKey)) {
            // Retrieve the videos from the cache
            $videos = Cache::get($cacheKey);
        } else {
            // Make the API call if the data is not cached
            $client = new Client();
            $apiKey = env('YOUTUBE_API_KEY');
            $apiUrl = "https://www.googleapis.com/youtube/v3/search?order=date&part=snippet&maxResults=10&key={$apiKey}";

            try {
                $response = $client->request('GET', $apiUrl);
                $videos = json_decode($response->getBody(), true);

                // Store the response in cache
                Cache::put($cacheKey, $videos, $cacheDuration);
            } catch (\Exception $e) {
                // Handle the exception (e.g., log the error, return a default value, etc.)
                $videos = []; // Set a default value in case of an error
            }
        }

        // Pass the videos to the view
        return view('birotanauen', ['videos' => $videos]);
    }

    public function techNews(Request $request) {
        $client = new Client();
        $page = $request->input('page', 1); // Get the current page or default to 1
        $pageSize = 3;
        $apiKey = env('NEWS_API_KEY');

        $response = $client->request('GET', "https://newsapi.org/v2/everything?q=all&pageSize={$pageSize}&page={$page}&apiKey={$apiKey}");
        $newsItems = json_decode($response->getBody(), true);

        // Assuming totalResults is provided in the API response
        $totalResults = $newsItems['totalResults'];
        $articles = collect($newsItems['articles']);

        // Create a LengthAwarePaginator instance
        $paginatedItems = new LengthAwarePaginator(
            $articles,
            $totalResults,
            $pageSize,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('technews', ['newsItems' => $paginatedItems]);
    }
}
