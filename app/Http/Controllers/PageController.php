<?php

namespace App\Http\Controllers;


use App\Models\News;
use App\Models\Songs;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

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
        $videos = Songs::all()->sortByDesc('publication_date');
        return view('birotanauen', ['videos' => $videos]);
    }

    public function techNews(Request $request) {
        $page = $request->input('page', 1); // Get the current page or default to 1
        $pageSize = 3;

        // Retrieve news items from the News model with pagination
        $paginatedNewsItems = News::paginate($pageSize, ['*'], 'page', $page);

        // The paginate method automatically handles totalResults and other pagination details

        return view('technews', ['newsItems' => News::all()]);
    }
}
