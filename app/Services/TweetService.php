<?php

namespace App\Services;

use App\Models\Tweet;
use App\Models\Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

    /**
     * ツイートを保存する
     *
     * @param integer $userId
     * @param string $content
     * @param array $images
     * @return void
     */
    public function saveTweet(int $userId, string $content, array $images): void {
        // DBファサードを利用してトランザクションを作成
        DB::transaction(function () use ($userId, $content, $images) {
            $tweet = new Tweet;
            $tweet->user_id = $userId;
            $tweet->content = $content;
            $tweet->save();
            foreach ($images as $image) {
                Storage::putFile('public/images', $image);
                $imageModele = new Image;
                // ランダムに名前を生成
                $imageModele->name = $image->hashName();
                $imageModele->save();
                // attach：Tweetモデルを経由して呟きと画像の交差テーブルにデータを保存
                $tweet->images()->attach($imageModele->id);
            }
        });
    }

    /**
     * ツイートを削除する
     *
     * @param integer $tweetId
     * @return void
     */
    public function deleteTweet(int $tweetId)
    {
        DB::transaction(function () use ($tweetId) {
            $tweet = Tweet::where('id', $tweetId)->firstOrFail();
            $tweet->images()->each(function ($image) use ($tweet){
                $filePath = 'public/images/' . $image->name;
                if(Storage::exists($filePath)){
                    Storage::delete($filePath);
                }
                // detach: 中間テーブルのデータを削除
                $tweet->images()->detach($image->id);
                $image->delete();
            });

            $tweet->delete();
        });
    }
}
