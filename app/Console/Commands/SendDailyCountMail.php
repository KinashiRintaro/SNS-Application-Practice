<?php

namespace App\Console\Commands;

use App\Mail\DailyTweetCount;
use App\Models\User;
use App\Services\TweetService;
use Illuminate\Console\Command;
use Illuminate\Contracts\Mail\Mailer;

class SendDailyCountMail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send-daily-tweet-count-mail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '前日のつぶやき数の集計結果メールを送ります。';

    private TweetService $tweetService;
    private Mailer $mailer;

    public function __construct(TweetService $tweetService, Mailer $mailer) {
        parent::__construct();
        $this->tweetService = $tweetService;
        $this->mailer = $mailer;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tweetCount = $this->tweetService->countYesterdayTweets();

        $users = User::get();

        foreach ($users as $user) {
            $this->mailer->to((string)$user->email)
                ->send(new DailyTweetCount($user, $tweetCount));
        }
    }
}
