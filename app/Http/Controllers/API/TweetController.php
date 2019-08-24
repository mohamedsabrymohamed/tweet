<?php

namespace App\Http\Controllers\api;

use App\Http\Requests\StoreTweet;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tweet;
use Illuminate\Http\Response;
use Illuminate\Session\Store;

class TweetController extends Controller
{
    public $successStatus = 200;

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(StoreTweet $request)
    {
        $validated = $request->validated();
        $tweet = Tweet::create($validated);
        return response()->json(['success' => $tweet], $this->successStatus);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $tweet = Tweet::find($id);

        if (!$tweet) {
            return response()->json(['message' => 'Record not found'], 404);
        }

        $tweet->delete();
        return response()->json(['message' => 'Record Deleted'], $this->successStatus);

    }


}
