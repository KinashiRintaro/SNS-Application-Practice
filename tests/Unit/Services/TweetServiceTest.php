<?php

namespace Tests\Unit\Services;

use PHPUnit\Framework\TestCase;
use App\Services\TweetService;
use Mockery;

/**
 * // 他のテストとは違うプロセスで動くように指示するアノテーション
 * @runInSeparateProcess
 */
class TweetServiceTest extends TestCase
{
    public function test_checkOwnTweet()
    {
        $tweetService = new TweetService();

        $mock = Mockery::mock('alias:App\Models\Tweet');
        // TODO: providerに置き換える
        $mock->shouldReceive('where->first')->andReturn((object)[
            'id' => 1,
            'user_id' => 1
        ]);

        $result = $tweetService->checkOwnTweet(1, 1);
        $this->assertTrue($result);
    }
}
