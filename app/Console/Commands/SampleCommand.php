<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SampleCommand extends Command
{
    /**
     * The name and signature of the console command.
     * コマンドの名前を書く
     *
     * @var string
     */
    protected $signature = 'sample-command';

    /**
     * The console command description.
     * コマンドの説明文を書く
     *
     * @var string
     */
    protected $description = 'sample-command description';

    /**
     * Execute the console command.
     * コマンドの実処理を書く
     *
     * @return int
     */
    public function handle()
    {
        echo 'このコマンドはサンプルです。';
        return Command::SUCCESS;
    }
}
