<?php

namespace App\Services;

use App\Models\Tweet;
use Carbon\Carbon;

class TweetService
{
    public function getTweets()
    {
        // Eager Loading：withを使用してtweetとimageは別のSQL文で呼び出すようにする（N＋1問題対策）
        return Tweet::with('images')->orderBy('created_at', 'DESC')->get();
    }

    public function checkOwnTweet(int $userId, int $tweetId): bool
    {
        $tweet = Tweet::where('id', $tweetId)->first();
        if (!$tweet) return false;
        return $tweet->user_id === $userId;
    }

    /**
     * 前日のツイート数をカウントする関数
     *
     * @return integer
     */
    public function countYesterdayTweets(): int {
        return Tweet::whereDate('created_at', '>=', Carbon::yesterday()->toDateTimeString())
            ->whereDate('created_at', '<', Carbon::today()->toDateTimeString())
            ->count();
    }
}
