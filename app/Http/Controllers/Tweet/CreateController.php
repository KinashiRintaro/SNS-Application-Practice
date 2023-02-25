<?php

namespace App\Http\Controllers\Tweet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Tweet\CreateRequest;
use App\Models\Tweet;
use App\Services\TweetService;

class CreateController extends Controller
{
    // Laravelではサービスコンテナによって自動的に指定したクラスをメソッドインジェクションしてくれる？
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(CreateRequest $request, TweetService $tweetService)
    {
        // コントローラからサービスクラスを利用して、コントローラの肥大化を防ぐ
        $tweetService->saveTweet(
            $request->userId(),
            $request->tweet(),
            $request->images(),
        );
        return redirect()->route('tweet.index');
    }
}
