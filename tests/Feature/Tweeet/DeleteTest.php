<?php

namespace Tests\Feature\Tweeet;

use App\Models\User;
use App\Models\Tweet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteTest extends TestCase
{
    // テストの実行前後にDBが初期化される
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_delete_successed()
    {
        $user = User::factory()->create();
        $tweet = Tweet::factory()->create([
            'user_id' => $user->id,
        ]);

        // 作成したユーザーでログインした状態にする
        $this->actingAs($user);
        
        // つぶやき削除のHTTPリクエスト「/tweet/delete//{tweetId}」に対するテスト
        $response = $this->delete('/tweet/delete/'. $tweet->id);

        $response->assertRedirect('/tweet');
    }
}
