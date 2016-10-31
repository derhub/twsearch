<?php
namespace App\Http\Controllers;

use App\Services\TwitterSearchService;
use Illuminate\Http\Request;

class TwitterSearchController extends Controller
{
    /**
     * The twitter search service class
     *
     * @var TwitterSearchService
     */
    protected $tweetService;

    public function __construct(TwitterSearchService $tweetService)
    {
        $this->tweetService = $tweetService;
    }

    /**
     * Search tweets
     *
     * @param  Request $request The laravel request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $city  = $request->get('city');
        $range = $request->get('range') ?? config('search.default_range');
        $geo   = $request->get('geo');

        $results = $this->tweetService->byCity($city, $geo, $range);

        return response()->json($results, 200);
    }
}
